<?php

use Illuminate\Routing\Route;

if(!function_exists('set_active_route')) {
    function set_active_route($route) {
        return Route::is($route) ? 'active btn-primary !important':'';
    }
}
