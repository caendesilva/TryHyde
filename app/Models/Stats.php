<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stats extends Model
{
    protected $fillable = ['event', 'value'];

    public static function dispatch(string $event, int $value = 0)
    {
        $event = self::where('event', $event)->firstOrFail();
        $event->update(['value' => $event->value + $value]);
    }
}
