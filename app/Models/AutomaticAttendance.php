<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AutomaticAttendance extends Model
{
    protected $fillable = [
        'email',
        'access_token',
        'channel_id',
        'message',
        'send_at_time',
        'monday',
        'tuesday',
        'wednesday',
        'thursday',
        'friday',
        'saturday',
        'sunday',
        'last_message_send_at',
        'last_message_send_status'
    ];
}
