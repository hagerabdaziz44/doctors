<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DoctorAppointmentDetail extends Model
{
    use HasFactory;
     protected $guarded =[];
    public function days(){
        return $this->belongsTo(Day::class,'day_id');
    }
}
