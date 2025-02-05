<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Report;
use App\Models\Settings;
use Sprain\SwissQrBill as QrBill;
use IntlDateFormatter;
use \Fpdf\Fpdf as FPDF;

class DocumentController extends Controller
{
    /**
     * Create the document and download it.
     *
     * @param int $id
     * @param $locale
     * @return \PhpOffice\PhpWord document
     *
     */

    public function update($locale, $id)
    {
        $fmt = datefmt_create('it_IT', IntlDateFormatter::FULL, IntlDateFormatter::FULL, 'Europe/Rome', IntlDateFormatter::GREGORIAN, 'dd MMMM yyyy');
        $report = Report::find($id);
        $prodotti = [];
        $brand = [];
        $vmodel = [];
        $plate = [];
        $hours = [];
        $iva = floor(($report->total * $report->tax / 100) / 0.05) * 0.05;
        $description = "";
        $model = 'modello' . $report->type . '.docx';
        $my_template = new \PhpOffice\PhpWord\TemplateProcessor(public_path($model));
        //informazioni cliente
        $my_template->setValue('titolo', $report->client->title);
        $my_template->setValue('nome', htmlspecialchars($report->client->name));
        $my_template->setValue('cognome', $report->client->surname);
        $my_template->setValue('indirizzo', $report->client->address);
        $my_template->setValue('cap', $report->client->postal_code);
        $my_template->setValue('citta', $report->client->city);
        $my_template->setValue('cantone', $report->client->region);
        $my_template->setValue('ncliente', $report->client->id);
        //Inserimento di tutti i veicoli in un array
        if (!is_null($report->wehicles)) {
            foreach ($report->vehicles as $vehicle) {
                array_push($brand, $vehicle->brand);
                array_push($vmodel, $vehicle->model);
                array_push($plate, $vehicle->plate);
                array_push($hours, $vehicle->hours);
            }
            //informazioni veicolo
            $my_template->setValue('veicolo', implode(' ', $brand));
            $my_template->setValue('modello', implode(' ', $vmodel));
            $my_template->setValue('targa', implode(' ', $plate));
            $my_template->setValue('ore', implode(' ', $hours));
            $my_template->setValue('veicololab', "Veicoli");
            $my_template->setValue('modellolab', "Modelli");
            $my_template->setValue('targalab', "Targhe");
            $my_template->setValue('orelab', "Ore");
        } else {
            $my_template->setValue('veicolo', "");
            $my_template->setValue('modello', "");
            $my_template->setValue('targa', "");
            $my_template->setValue('ore', "");
            $my_template->setValue('veicololab', "");
            $my_template->setValue('modellolab', "");
            $my_template->setValue('targalab', "");
            $my_template->setValue('orelab', "");
        }
        $my_template->setValue('tipodoc', $report->type);
        $my_template->setValue('nomedoc', $report->name);
        $my_template->setValue('data', datefmt_format($fmt, strtotime($report->date)));
        $my_template->setValue('totaleivaescl', number_format($report->total, 2, ".", "'"));
        $my_template->setValue('totaleiva', number_format($iva, 2, ".", "'"));
        $my_template->setValue('totaleivaincl', number_format($iva + $report->total, 2, ".", "'"));
        $my_template->setValue('totaleiva10g', number_format(round((($iva + $report->total) - (($iva + $report->total) * 3 / 100)) * 2, 1) / 2, 2, ".", "'"));
        $my_template->setValue('iva', $report->tax);

        //Inserimento dei prodotti nella tabella
        foreach ($report->products as $product) {
            $lines = explode("\r\n", $product->pivot->description);
            if (count($lines) > 1) {
                foreach ($lines as $line) {
                    $description = $description . "<w:t xml:space='preserve'>" . $line . "</w:t><w:br/>";
                }
                array_push($prodotti, ['articolo' => $product->name, 'descrizione' => "<w:r>" . $description . "</w:r>", 'qta' => $product->pivot->qta, 'unita' => $product->unit, 'prezzo' => number_format(round(($product->pivot->sum / $product->pivot->qta) / 0.05) * 0.05, 2, ".", "'"), 'somma' => number_format($product->pivot->sum, 2, ".", "'")]);
            } else {
                array_push($prodotti, ['articolo' => $product->name, 'descrizione' => $product->pivot->description, 'qta' => $product->pivot->qta, 'unita' => $product->unit, 'prezzo' => number_format(round(($product->pivot->sum / $product->pivot->qta) / 0.05) * 0.05, 2, ".", "'"), 'somma' => number_format($product->pivot->sum, 2, ".", "'")]);
            }
            $description = "";
        }
        $my_template->cloneRowAndSetValues('articolo', $prodotti);
        try {
            $my_template->saveAs(storage_path($report->name . '.docx'));
        } catch (Exception $e) {
            //handle exception
        }
        return response()->download(storage_path($report->name . '.docx'));
    }

    /**
     * Download the instruction file.
     *
     * @param $locale
     * @return instruction
     *
     */
    public function getInstruction($locale)
    {
        $file = public_path() . "/Istruzioni.pdf";
        $headers = array('Content-Type: application/pdf',);
        return response()->download($file, 'Istruzioni.pdf', $headers);
    }

    /**
     * Download PDF with the QR-bill
     *
     * @param $locale
     * @param int $id
     * @return QrBill\PaymentPart\Output\FpdfOutput\FpdfOutput QR-bill
     *
     */
    public function createQR($locale, $id)
    {
        $setting = Settings::first();
        $report = Report::find($id);
        $iva = floor(($report->total * $report->tax / 100) / 0.05) * 0.05;
        $qrBill = QrBill\QrBill::create();
        //Informazioni del creditore
        $qrBill->setCreditor(
            QrBill\DataGroup\Element\CombinedAddress::create(
                $setting->name,
                $setting->address,
                $setting->postal_code,
                'CH'
            ));
        $qrBill->setCreditorInformation(
            QrBill\DataGroup\Element\CreditorInformation::create(
                $setting->bank_account // With SCOR, this is a classic iban. QR-IBANs will not be valid here.
            ));
        //Informazioni del debitore
        $qrBill->setUltimateDebtor(
            QrBill\DataGroup\Element\StructuredAddress::createWithStreet(
                $report->client->name . ' ' . $report->client->surname,
                $report->client->address,
                ' ',
                $report->client->postal_code,
                $report->client->city,
                'CH'
            ));
        //Il totale da pagare
        $qrBill->setPaymentAmountInformation(
            QrBill\DataGroup\Element\PaymentAmountInformation::create(
                'CHF',
                $report->total + $iva
            ));
        //Referenze di pagamento *nessuna*
        $qrBill->setPaymentReference(
            QrBill\DataGroup\Element\PaymentReference::create(
                QrBill\DataGroup\Element\PaymentReference::TYPE_NON
            ));
        //Informazioni inerenti la fattura *nome+
        $qrBill->setAdditionalInformation(
            QrBill\DataGroup\Element\AdditionalInformation::create(
                $report->name
            )
        );
        //Creazione dei QR come immagini
        try {
            $qrBill->getQrCode()->writeFile(storage_path('/qr.png'));
            $qrBill->getQrCode()->writeFile(storage_path('/qr.svg'));
        } catch (Exception $e) {
            foreach ($qrBill->getViolations() as $violation) {
                print $violation->getMessage() . "\n";
            }
            exit;
        }

        //Creazione del file pdf
        define('FPDF_FONTPATH', public_path() . '/fonts');
        $fpdf = new FPDF('P', 'mm', 'A4');
        // $fpdf->fontpath = 'D:/github.com/darky910/MM-Agricole/public/fonts';
        $fpdf->AddFont('Akzidenz', '', 'Akzidenz-grotesk-roman_0.php');
        $fpdf->AddFont('Akzidenz', 'B', 'AkzidenzGrotesk-bold_0.php');
        $fpdf->SetMargins(20, 50, 20);
        $fpdf->AddPage();
        /*Logo
        *  $fpdf->Image(public_path(''),18,8,68);
        */
        $fpdf->SetFont('Akzidenz', 'B', 10);
        $fpdf->Cell(0, 4.3, $report->type . ' ' . $report->name);
        $fpdf->ln(8.6);
        $fpdf->SetFont('Akzidenz', '', 10);
        $fpdf->Cell(0, 4.3, 'Termine di reclamo');
        $fpdf->SetX(120);
        $fpdf->Cell(0, 4.3, '10 giorni');
        $fpdf->ln(8.6);
        $fpdf->Cell(0, 4.3, 'Termine di pagamento');
        $fpdf->SetX(120);
        $fpdf->Cell(0, 4.3, '10 giorni 3% di sconto');
        $fpdf->Cell(0, 4.3, number_format(round((($iva + $report->total) - (($iva + $report->total) * 3 / 100)) * 2, 1) / 2, 2, ".", "'"), 0, 0, 'R');
        $fpdf->ln();
        $fpdf->SetX(120);
        $fpdf->Cell(0, 4.3, '30 giorni netto');
        $fpdf->Cell(0, 4.3, number_format($iva + $report->total, 2, ".", "'"), 0, 0, 'R');
        $fpdf->ln(17.2);
        $fpdf->Cell(0, 4.3, 'Banca');
        $fpdf->SetX(120);
        $fpdf->Cell(0, 4.3, $setting->bank_name);
        $fpdf->ln();
        $fpdf->Cell(0, 4.3, 'IBAN');
        $fpdf->SetX(120);
        $fpdf->Cell(0, 4.3, $setting->bank_account);
        //Aggiunta del QR al PDF
        $output = new QrBill\PaymentPart\Output\FpdfOutput\FpdfOutput($qrBill, 'en', $fpdf);
        $output
            ->setPrintable(false)
            ->getPaymentPart();
        //Salvataggio del QR nella cartella del server e download
        $serverPath = $report->name . "-qr.pdf";
        $fpdf->Output($serverPath, 'D');
    }
}
