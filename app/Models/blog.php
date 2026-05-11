<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class blog extends Model
{
    protected $table = 'blog';
    protected $primaryKey = 'id_blog';

    protected $fillable = [
        'judul_artikel',
        'penulis',
        'content',
        'created_at',
        'updated_at',
        'user_id',
        'cover',
        'slug',
    ];

    public function user()
{
    return $this->belongsTo(User::class);
}
}

