<?php
namespace App\Models\lib;

use App\Models\lib\IRensikeRepo;

class RensikeService{

    protected $rensikeRepo;
    public function __construct(IRensikeRepo $rensikeRepo){
         $this->rensikeRepo = $rensikeRepo;
    }

    public function getAllData()
    {
        return $this->rensikeRepo->fetchAll();
    }
}