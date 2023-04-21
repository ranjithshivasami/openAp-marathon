<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmailQueues extends Model
{
    use HasFactory;
    protected $primaryKey='id';
    protected $fillable = [
        'from', 'to', 'cc', 'bcc','subject','message', 'template', 'template_details', 'attachments','error','error_message','priority','status'
    ];
}
