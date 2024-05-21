<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientClinicAppointment extends Model
{
    use HasFactory;
    protected $guarded =[];
    public function patient()
    {
        return $this->belongsTo(Patient::class,'patient_id');
    }
    public function days(){
        return $this->belongsTo(Day::class,'day_id');
    }

}
