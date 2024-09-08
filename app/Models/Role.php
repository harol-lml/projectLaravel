<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    /**
     * Relation between users
     *
     * @return mixed
     */
    public function users() {
    	return $this->belongsToMany('App\Models\User');
    }

    /**
     * Relation between permission
     *
     * @return mixed
     */
    public function permissions() {
    	return $this->belongsToMany('App\Models\Permission');
    }
}
