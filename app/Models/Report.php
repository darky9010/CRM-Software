<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;
    protected $fillable = ['type', 'name','r_terms','p_terms','tax','total','status','client_id'];

    public function products(){
        return $this->belongsToMany(Product::class)->withPivot('qta','sum','description')->withTimestamps();
    }

    public function vehicles(){
        return $this->belongsToMany(Vehicle::class)->withTimestamps();
    }

    public function client(){
        return $this->belongsTo(Client::class);
    }
}
