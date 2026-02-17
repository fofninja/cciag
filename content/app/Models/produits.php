<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class produits extends Model
{
	 use HasFactory;
   protected $table = 'produits';
   protected $primaryKey = 'id_prod';
   public 	 $timestamps = false;
   protected $fillable = ['nom_prod','prix_prod','code_prod','id_categ','conditionnement','qt_par_group','seuil'];
}
