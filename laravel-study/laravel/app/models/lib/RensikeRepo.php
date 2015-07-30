<?php
namespace App\Models\lib;
use User;
class RensikeRepo implements IRensikeRepo{
    public function fetchAll()
    {
        return User::all();
    }
}