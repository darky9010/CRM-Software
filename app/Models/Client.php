<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use const http\Client\Curl\VERSIONS;

class Client extends Model
{
    use HasFactory;
    protected $fillable = ['title','name','surname','address','address1','mail','phone','postal_code','city','region','note'];

    public function vehicles(){
        return $this->hasMany(Vehicle::class);
    }

    public function reports(){
        return $this->hasMany(Report::class);
    }
}
