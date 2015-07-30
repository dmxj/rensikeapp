<?php
namespace App\Models\lib;

use Illuminate\Support\Facades\Facade;

class RensikeFacade extends Facade{
    protected static function getFacadeAccessor() {
        return 'rensikeService';
    }
}