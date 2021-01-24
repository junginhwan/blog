<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Scopes\UserScope;

class TodoItem extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'name', 'completed', 'completed_at'];

    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new UserScope);
    }
}
