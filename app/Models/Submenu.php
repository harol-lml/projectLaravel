<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Submenu extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'description','menu_id'];

     /**
     * Relation between menu
     *
     * @return mixed
     */
    public function menu() {
    	return $this->belongsTo('App\Models\Menu');
    }
}
