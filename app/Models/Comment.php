<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'text',
        'user_id',
        'blog_id'
    ];

    public function blog()
    {
        return $this->belongsTo(Blog::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

     // Set a default value of null for the user_id field
     public function __construct(array $attributes = [])
     {
         parent::__construct($attributes);
         $this->attributes['user_id'] = null;
     }
}

