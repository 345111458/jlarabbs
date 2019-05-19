<?php

namespace App\Models;

class Reply extends Model
{
    protected $fillable = ['content'];


    public function user(){


        return $this->belongsTo(user::class);
    }


    public function topic(){


        return $this->belongsTo(Topic::class);
    }
}
