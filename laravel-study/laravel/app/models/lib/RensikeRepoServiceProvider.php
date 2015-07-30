<?php
namespace App\Models\lib;
use Illuminate\Support\ServiceProvider;

class RensikeRepoServiceProvider extends ServiceProvider{

    public function register()
    {
        $this->app->bind('IRensikeRepo',function($app){
              return new RensikeRepo();
        });
    }

}