<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClinicSpecialization extends Model
{
    use HasFactory;
     protected $guarded =[];
    public function specialization()
    {
        return $this->belongsTo(Specialization::class,'specialization_id');
    }
    public function clinic(){
        return $this->belongsTo(Clinic::class,'clinic_id');
    }

}
