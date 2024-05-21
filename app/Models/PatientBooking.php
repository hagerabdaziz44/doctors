<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientBooking extends Model
{
    use HasFactory;
    protected $guarded =[];
    public function clinic(){
        return $this->belongsTo(Clinic::class,'clinic_id');
    }
    public function doctor(){
        return $this->belongsTo(Doctor::class,'doctor_id');
    }
     public function doctorappointment(){
        return $this->belongsTo(DoctorAppointmentDetail::class,'doctor_appointment_detail_id');
    }
    public function patient()
    {
        return $this->belongsTo(Patient::class,'patient_id');
    }
    
}
