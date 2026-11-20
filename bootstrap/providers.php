<?php

use App\Providers\AppServiceProvider;
use App\Providers\FortifyServiceProvider;
use App\Providers\HelperServiceProvider;
use App\Providers\TelescopeServiceProvider;

return [
    AppServiceProvider::class,
    FortifyServiceProvider::class,
    TelescopeServiceProvider::class,
    HelperServiceProvider::class,
];
