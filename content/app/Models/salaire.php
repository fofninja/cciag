<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class salaire extends Model
{
	 use HasFactory;
   protected $table = 'salaire';
   protected $primaryKey = 'id_salaire';
   public 	 $timestamps = false;
   protected $fillable = ['id_pers','mois_salaire','montant_avance','montant_salaire'];

                

}
