<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class materiels extends Model
{
	 use HasFactory;
   protected $table = 'materiels';
   protected $primaryKey = 'id_mat';
   public 	 $timestamps = false;
   protected $fillable = ['nom_mat','qt_mat'];
}

     