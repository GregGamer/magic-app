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
        $now = Carbon::now();
        $key = 'last_updated_date';

        $last_updated_date = self::firstOrCreate(['key' => $key], ['value' => $now])->value;

        if($now->diffInWeeks($last_updated_date)){
            self::where('key', $key)->update(['value' => $now]);
            return true;
        }
        return false;
    }
}
