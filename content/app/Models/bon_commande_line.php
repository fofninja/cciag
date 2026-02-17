<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class bon_commande_line extends Model
{
	 use HasFactory;
   protected $table = 'bon_commande_line';
   protected $primaryKey = 'id_bon_cmd_line';
   public 	 $timestamps = false;
   protected $fillable = ['num_bon_cmd','code_prod','qt_cmd','prix_achat','montant_cmd','id_mag'];

           

}
