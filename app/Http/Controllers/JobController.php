<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jobs\SendWelcomeEmail;
use Carbon\Carbon;

use function Laravel\Prompts\alert;

class JobController extends Controller
{
    /**
     * Handle Queue Process
     */
    public static function processQueue($email)
    {
        // $emailJob = (new SendWelcomeEmail())->delay(Carbon::now()->addMinutes(1));
        $emailJob = new SendWelcomeEmail($email);
        dispatch($emailJob);
    }
}