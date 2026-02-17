<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class vente_groupe extends Model
{
     use HasFactory;
   protected $table = 'vente_groupe';
   protected $primaryKey = 'id_gr_vente';
   public    $timestamps = false;
   protected $fillable = ['code_vente','date_vente','montant_vente','montant_remise','montant_to_pay','montant_paye','montant_paye_fixe','code_cl','mode_paye','id_mag','id_user'];


}
                                             