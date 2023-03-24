<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mail_content extends Model
{
    public $timestamps = false;

    protected $fillable = ['from', 'subject', 'mailrecvdate','body'];
}
