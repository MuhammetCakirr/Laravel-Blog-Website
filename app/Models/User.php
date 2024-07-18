<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
class User extends Authenticatable implements AuthenticatableContract
{
    use HasRoles;
    use HasFactory;
    use Notifiable;
    protected $table = "users";
    protected $fillable = ["is_approved","fname", "lname", "email", "password", "'photo_url'"];

    public function posts()
    {
        return $this->hasMany(Post::class, 'publisher_id');
    }
    public function editedPosts()
    {
        return $this->hasMany(Post::class, 'editor_id');
    }
}
