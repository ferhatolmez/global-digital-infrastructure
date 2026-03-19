<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Schedule::command('domains:sync-prices')->dailyAt('02:00')->withoutOverlapping();

Schedule::command('prices:sync')->dailyAt('02:00');

Schedule::command('app:check-expired-domains')->daily();
