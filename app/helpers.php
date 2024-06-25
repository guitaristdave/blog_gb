<?php

use Illuminate\Support\Facades\Route;

if(!function_exists("active_link")) {
    function active_link($route, $class = "active") {
        return Route::is($route) ? $class : "";
    }
}
