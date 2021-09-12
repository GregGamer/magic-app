<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'key',
        'value'
    ];

    public static function week_old(){
        $diffInWeeks = Carbon::now()->diffInWeeks(self::firstOrCreate(['key' => 'last_updated_date'],['value' => Carbon::now()->subWeek()])->value);

        if ($diffInWeeks >= 1)
            self::where('key', 'last_updated_date')->update(['value' => Carbon::now()]);
        return $diffInWeeks;
    }

    public static function key($key){
        return self::where('key', $key)->first()->value;
    }
}
