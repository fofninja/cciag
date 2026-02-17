<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class materiel_apr extends Model
{
	 use HasFactory;
   protected $table = 'materiel_apr';
   protected $primaryKey = 'id_mat_apr';
   public 	 $timestamps = false;
   protected $fillable = ['id_mat','date_mat_apr','qt_mat_apr'];
}
              
