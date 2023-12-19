<?php

namespace App\Models;
use DateTimeInterface;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    use HasFactory;

    /**
     * Prepare a date for array / JSON serialization.
     *
     * @param  \DateTimeInterface  $date
     * @return string
     */

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('d-m-Y H:i:s');
    }

    protected $table = 'activity_log';

    protected $fillable = [
        'activity',
        'url',
        'ip',
        'agent',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
