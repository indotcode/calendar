<?php
Route::prefix('calendar')->group(function () {
    Route::put('/ajax/{name}', 'Indotcode\Calendar\Controller\CalendarController@ajax')->name('calendar')->where('name', '[A-Za-z]+');
});
