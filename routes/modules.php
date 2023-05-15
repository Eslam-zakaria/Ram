<?php

use Illuminate\Support\Facades\Route;

foreach (registeredModules() as $module) {
    Route::group([], base_path("Modules/{$module}/routes.php"));
}
