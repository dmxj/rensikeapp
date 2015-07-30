<?php
namespace App\Models\lib;

use Illuminate\Support\ServiceProvider;

class RensikeServiceServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind('rensikeService', function($app)
        {
            return new RensikeService(
                $app->make('IRensikeRepo')
            );
        });
    }
}