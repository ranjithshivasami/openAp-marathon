<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mailcontent extends Model
{
    public $timestamps = false;
    protected $table = 'mail_contents';

    protected $fillable = ['from', 'subject', 'mailrecvdate','body'];
}
