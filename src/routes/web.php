<?php
Route::prefix('calendar')->group(function () {
    Route::post('/ajax/{name}', 'Indotcode\Calendar\Controller\CalendarController@ajax')->name('calendar')->where('name', '[A-Za-z]+');
});
