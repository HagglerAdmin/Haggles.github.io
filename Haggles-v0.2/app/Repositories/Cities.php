<?php

namespace App\Repositories;

use App\City;

class Cities 
{
    public function all () 
    {
        $city = City::join('provinces','provinces.id','=','cities.province_id')
        
        ->selectRaw('(cities.name) city, (provinces.name) province')

        ->orderBy('city')

        ->get();

        return $city;

    }
}