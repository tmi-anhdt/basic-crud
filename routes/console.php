<?php

use App\Jobs\SendWelcomeEmail;
use Illuminate\Support\Facades\Schedule;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Schedule::job(function () {
    $emailJob = new SendWelcomeEmail("tuananhdao2862@gmail.com");
    dispatch($emailJob);
})->everyTenSeconds();

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();