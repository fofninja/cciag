<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class historique_reglement_bc extends Model
{
	 use HasFactory;
   protected $table = 'historique_reglement_bc';
   protected $primaryKey = 'id_reglement';
   public 	 $timestamps = false;
   protected $fillable = ['date_reglement','num_bon_cmd','montant_paye','mode_pay','id_user'];
}
