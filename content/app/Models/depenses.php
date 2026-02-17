<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class depenses extends Model
{
	 use HasFactory;
   protected $table = 'depenses';
   protected $primaryKey = 'id_dep';
   public 	 $timestamps = false;
   protected $fillable = ['date_dep','montant_dep','motif_dep','initiateur_dep'];
}
          
