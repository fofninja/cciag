<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class remboursement extends Model{
	use HasFactory;
   protected $table = 'remboursement';
   protected $primaryKey = 'id_rb';
   public 	 $timestamps = false;
   protected $fillable = ['montant_rb','date_rb','code_vente','code_cl'];
}
