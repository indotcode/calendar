<?php
use Illuminate\Support\Facades\Route;
use Indotcode\Calendar\Controller\CalendarController;

Route::prefix('calendar')->group(function () {
    Route::post('/ajax/{name}', [CalendarController::class, 'ajax'])->name('calendar')->where('name', '[A-Za-z]+');
});
