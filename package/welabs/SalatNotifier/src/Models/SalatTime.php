<?php

namespace welabs\SalatNotifier\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalatTime extends Model
{
    use HasFactory;
    protected $fillable = ['salat','time','notification_sent'];
    protected $table = 'salat_times';
}
