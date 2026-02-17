<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class productions extends Model
{
	 use HasFactory;
   protected $table = 'productions';
   protected $primaryKey = 'id_prd';
   public 	 $timestamps = false;
   protected $fillable = ['id_prod','date_prd','qt_prd'];
}
