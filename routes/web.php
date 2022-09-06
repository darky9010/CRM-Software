<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\StatisticController;
use App\Http\Controllers\SettingsController;
use Illuminate\Support\Facades\Lang;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [ReportController::class, 'index']);


    Route::group(['prefix' => '{locale}', 'where' => ['locale' => '[a-zA-Z]{2}'], 'middleware' => 'setlocale'], function () {
        //Percorso per la home
        Route::get('/dashboard', [ReportController::class, 'index'])->name('dashboard');

        //Percorsi per i prodotti
        Route::resource('products', ProductController::class);
        Route::get('/archive', [ProductController::class,'indexarchive'])->name('archive');

        //Percorsi per i clienti
        Route::resource('clients', ClientController::class);

        //Percorsi per i veicoli
        Route::resource('vehicles', VehicleController::class);
        Route::get('vehicles/create/{client_id}',[VehicleController::class,'create'])->name('vehicle.create');

        //Percorsi per i fornitori
        Route::resource('companies', CompanyController::class);

        //Impostazioni
        Route::resource('settings', SettingsController::class);

        //Percorsi per i contatti dei fornitori
        Route::resource('contacts', ContactController::class);
        Route::get('contact/create/{company_id}',[ContactController::class,'create'])->name('contact.create');

        //Percorsi per i report/fatture
        Route::resource('reports', ReportController::class);
        Route::get('reports/create/{client_id}',[ReportController::class,'usercreate'])->name('reports.usercreate');
        Route::delete('reports/{report}/removeProduct/{product}', [ReportController::class, 'removeProduct'])->name('remove.product');
        Route::get('reports/delete/{report}/{type}',[ReportController::class,'delete'])->name('report.delete');
        Route::delete('reports/destroy/{report}/{type}',[ReportController::class,'destroy'])->name('report.destroy');

        //Route::resource('documents',DocumentController::class);
        Route::post('document/{id}', [DocumentController::class, 'update'])->name('document.update');
        Route::get('document/{id}/qr', [DocumentController::class, 'createQR'])->name('document.qr');
        Route::get('instruction/{filename}', [DocumentController::class,'getInstruction'])->name('instruction');

        Route::get('statistics',[StatisticController::class,'statistics'])->name('statistics');
    });

    //Percorsi per le chiamate ajax
    Route::get('reports/getClientVehicles/{id}', [VehicleController::class, 'getClientVehicles']);
    Route::get('reports/getVehicleHours/{id}', [VehicleController::class, 'getVehicleHours']);
    Route::get('reports/getProductPrice/{id}', [ProductController::class, 'getProductPrice']);
    Route::get('reports/getProductDescription/{id}', [ProductController::class, 'getProductDescription']);

require __DIR__ . '/auth.php';
