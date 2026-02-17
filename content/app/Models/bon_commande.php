<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class bon_commande extends Model
{
	 use HasFactory;
   protected $table = 'bon_commande';
   protected $primaryKey = 'id_bon_cmd';
   public 	 $timestamps = false;
   protected $fillable = ['num_bon_cmd','date_bon_cmd','montant_bon_cmd','montant_paye','mode_paye','id_fournisseur','charge'];
}
