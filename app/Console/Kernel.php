<?php

namespace DICOM\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

use Illuminate\Http\Request;
use DB;
use PDO;
use Session;
use Redirect;
use Carbon\Carbon;
use DICOM\ConvenioModel;
use DICOM\Efi_FondoModel;
use DICOM\Efi_Comprobante_Pago_Model;
use DICOM\User;


class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        Commands\ChequeaCampanias::class
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

        //$schedule->command('chequea:campanias')->hourly();
       // $schedule->command('chequea:campanias')->cron('*/3','*','*','*','*','*');

        $schedule->call(function () {
       /* $chapters = Chapter::where('published', '=', false)->where('published_at', '<=', Carbon::now()->toDateTimeString())->get();
        foreach($chapters as $chapter) {
           // Código para hacer público el artículo, enviar a Twitter, etc.
        }*/
       // echo Session::get('idusuario');
    })->hourly();


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
