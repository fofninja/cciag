<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class dommage extends Model
{
    use HasFactory;
   protected $table = 'dommage';
   protected $primaryKey = 'id_dm';
   public 	 $timestamps = false;
   protected $fillable = ['date_dn','id_prod','qt_dn'];
}
