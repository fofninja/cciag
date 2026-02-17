<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class materiel_sortie extends Model
{
	 use HasFactory;
   protected $table = 'materiel_sortie';
   protected $primaryKey = 'id_mat_out';
   public 	 $timestamps = false;
   protected $fillable = ['id_mat','date_mat_out','heure_mat_out','qt_dommage','qt_mat_out','type_mat_out'];
}
              
              
