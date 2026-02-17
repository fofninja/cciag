<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class credits extends Model
{
	 use HasFactory;
   protected $table = 'credits';
   protected $primaryKey = 'id_credit';
   public 	 $timestamps = false;
   protected $fillable = ['montant_credit','montant_paye','reste','date_credit','code_vente','code_cl','id_mag','id_user'];
}
