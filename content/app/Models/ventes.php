<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ventes extends Model
{
     use HasFactory;
   protected $table = 'ventes';
   protected $primaryKey = 'id_vente';
   public    $timestamps = false;
   protected $fillable = ['code_vente','code_prod','nom_prod','qt_vente','qt_livree','pu_vente','montant_vente','montant_remise','montant_to_pay','date_vente','mode_paye','code_cl','id_mag','id_user'];
}