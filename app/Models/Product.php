<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name','description','b_price','s_price','stock','check','in_order','re_order','location_A','location_B','location_C','unit'];

    public function companies(){
        return $this->belongsToMany(Company::class)->withPivot('serial_n')->withTimestamps();
    }

    public function reports(){
        return $this->belongsToMany(Report::class)->withPivot('qta','sum','description')->withTimestamps();
    }
}
