<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cadeau extends Model
{
	 use HasFactory;
   protected $table = 'cadeau';
   protected $primaryKey = 'id_cadeau';
   public 	 $timestamps = false;
   protected $fillable = ['date_cadeau','id_prod','qt_cadeau','commentaire'];
}
             
