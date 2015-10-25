<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Motobike extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'products';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [ 'model_name' , 'model_date' , 'vendor' , 'color' , 'cc' , 'weight' , 'price' , 'img_src'];
}
