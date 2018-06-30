<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AppUser extends Model
{
    protected $fillable=['firstname','lastname','email','password'];

    public function user(){
    	return $this->belongsTo(User::class);
    }
}
