<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Filter extends Model
{
    protected $fillable = [
        'name',
        'creator_name',
        'creator_social_media',
        'filter_unlock_link',
    ];

    public static function factory()
    {
    }
}
