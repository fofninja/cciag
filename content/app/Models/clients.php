<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class clients extends Model
{
	 use HasFactory;
   protected $table = 'clients';
   protected $primaryKey = 'id_cl';
   public 	 $timestamps = false;
   protected $fillable = ['code_cl','nom_cl','tel_cl','montant_solde_cl'];
}
