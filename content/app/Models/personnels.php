<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class personnels extends Model
{
	 use HasFactory;
   protected $table = 'personnels';
   protected $primaryKey = 'id_pers';
   public 	 $timestamps = false;
   protected $fillable = ['nom','prenom','fonction','tel','salaire'];
}
          
          
