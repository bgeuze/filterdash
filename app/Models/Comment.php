<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
//    use HasFactory;

    protected $fillable = ['body', 'filter_id', 'user_id'];

    public function filter()
    {
        return $this->belongsTo(Filter::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

