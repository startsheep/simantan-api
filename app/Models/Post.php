<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'image',
        'description',
        'flag_id',
        'user_id',
    ];

    public function getImageAttribute($image)
    {
        return $this->attributes['image'] = url('storage/' . $image);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function flag(): BelongsTo
    {
        return $this->belongsTo(Flag::class);
    }

    public function likes(): HasMany
    {
        return $this->hasMany(Like::class, 'post_id');
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class, 'post_id');
    }
}
