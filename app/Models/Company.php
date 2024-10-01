<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;
    protected $fillable = ['name','initials','address','address1','mail','postal_code','city','region','phone','site'];

    public function products(){
        return $this->belongsToMany(Product::class)->withPivot('serial_n')->withTimestamps();
    }

    public function contacts(){
        return $this->hasMany(Contact::class);
    }
}
