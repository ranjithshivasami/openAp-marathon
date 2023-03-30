<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserMailsetting extends Model
{
    use HasFactory;
    protected $table = 'user_mail_settings';
    protected $fillable = [
        'primary_email',
        'secondary_email',
        'mail_server',
        'port',
        'protocol',
        'password',
        'user_id',
    ];


    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
