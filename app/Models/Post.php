<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Post extends Model
{
    use HasFactory;

    protected function casts(): array
    {
        return [
            'published' => 'datetime',
        ];
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function scopePublished($query)
    {
        $query->where('published', '<=', now());

    }

    public function scopeFeatured($query)
    {
        $query->where('featured', true);

    }

    public function getExcerpt()
    {
        return Str::limit(strip_tags($this->body), 150);
    }
    public function getReadingTime()
    {
        $mins = round(str_word_count($this->body) /250);

        return ($mins < 1) ? 1 : $mins;
    }
}
