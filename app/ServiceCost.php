<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ServiceCost extends Model
{
    public function serviceCost($id){
        return DB::table('service_costs')
            ->where('booking_id',$id)
            ->sum('total_price');
    }
}
