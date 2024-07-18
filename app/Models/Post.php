<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $table = "post";
    protected $fillable = ["publisher_id", "editorId", "title", "content", "photo_url", "url","status"];

    public function publisher()
    {
        return $this->belongsTo(User::class, 'publisher_id');
    }

    public function editor()
    {
        return $this->belongsTo(User::class, 'editor_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'post_id')->with('user'); // Yorumlarla birlikte kullanıcıyı da yükle
    }

    public function getFormattedCreatedAtAttribute()
    {
        return Carbon::parse($this->created_at)->format('F j, Y');
    }
}
