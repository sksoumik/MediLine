<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Medicine extends Model
{
    //mass fillable datas. This is for med providers when they 
    //wanna upload meds to thedatabase
    protected $fillable = [
        'med_name', 'med_group', 'power_mg', 'price',
    ];
}
