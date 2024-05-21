<?php

namespace App\Console\Commands;

use App\Models\Clinic;
use App\Models\Day;
use App\Models\ClinicAppointment;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;

class CheckClinicStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'clinic:check';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $date = Carbon::now()->timezone('Africa/Cairo');
        $all= $date;
        $day_name= $all->englishDayOfWeek;
        $days=Day::where('name_en', $day_name)->first();
        $day=$days->id;
        $appointments=ClinicAppointment::get();
        foreach ($appointments as $appointment) {
            if ($appointment->start1==null && $appointment->start2==null ) {
                $appointment->update(['status' => 'closed']);
                Clinic::where('id',$appointment->clinic_id)->update([
                    'status'=>'closed',
                ]);
            } 
            else{
            $startDate = Carbon::createFromFormat('H:i:s', $appointment->start1);
            $endDate = Carbon::createFromFormat('H:i:s', $appointment->end1);
            $startDate2 = Carbon::createFromFormat('H:i:s', $appointment->start2);
            $endDate2 = Carbon::createFromFormat('H:i:s', $appointment->end2);

            $check = Carbon::now()->timezone('Africa/Cairo')->between($startDate, $endDate, true);

             $check2 =Carbon::now()->timezone('Africa/Cairo')->between($startDate2, $endDate2, true);

            if ($check || $check2) {
                $appointment->update(['status' => 'opened']);
                Clinic::where('id',$appointment->clinic_id)->update([
                    'status'=>'open',
                ]);
            } 
            elseif ($appointment->start1==null && $appointment->start2==null ) {
                $appointment->update(['status' => 'closed']);
                Clinic::where('id',$appointment->clinic_id)->update([
                    'status'=>'closed',
                ]);
            } 
            else
            {
                $appointment->update(['status' => 'closed']);
                Clinic::where('id',$appointment->clinic_id)->update([
                    'status'=>'closed',
                ]);
            }
                
            }
        }
        

    }
}
