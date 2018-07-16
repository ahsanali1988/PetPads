<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        \App\Console\Commands\ProcessPaymentApprove::class,
        \App\Console\Commands\ShipmentTracking::class,
        \App\Console\Commands\FetchTransactionAmount::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')
        //          ->hourly();
        $filePath = base_path('storage/logs/cron.log');
         $schedule->command('ProcessPaymentApprove:processpayment')
                 ->withoutOverlapping()
                 ->everyMinute()
                 ->appendOutputTo($filePath);

         // it will run after every 3 hours and check the status of orders
         $schedule->command('OrderShipmentTracking:shipmenttracking')
             ->withoutOverlapping()
             ->cron('0 */3 * * *');
         
    }

    /**
     * Register the Closure based commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        require base_path('routes/console.php');
    }
}
