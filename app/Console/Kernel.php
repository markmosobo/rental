<?php

namespace App\Console;

use App\Jobs\GenerateRentBills;
use App\Jobs\ScheduleReminders;
use App\Jobs\SendReminder;
use App\Jobs\SendSms;
use App\Models\CustomerMessage;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->job(new GenerateRentBills())->everyMinute();
//        $schedule->job(new ScheduleReminders())->everyMinute();
//        $schedule->call(function () {
////            Log::info('executing');
//            $customerMessages = CustomerMessage::where('sent',false)->get();
//            if(count($customerMessages)){
//                foreach ($customerMessages as $message){
//                    SendSms::dispatch($message->message,$message->phone_number);
//                    $message = CustomerMessage::find($message->id);
//                    $message->sent = true;
//                    $message->save();
//                }
//            }
//
//        })->everyMinute();

        // make database backup
        $schedule->command('backup:run --only-db')->hourly();

        $schedule->command('backup:clean')->daily();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
