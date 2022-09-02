<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;

    protected $fillable = ['brand','model','plate','hours','client_id'];

    public function client(){
        return $this->belongsTo(Client::class);
    }

    public function reports(){
        return $this->hasMany(Report::class);
    }
}
