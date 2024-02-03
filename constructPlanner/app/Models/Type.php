<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'color', 'user_id'];

    public function works() {
        return $this->hasMany(Work::class);
    }
    public function user() {
        return $this->belongsTo(User::class)->withDefault();
    }

    public function scopeSearchType($query, $search = '%') {
        return $query->where('name', 'like', "%{$search}%");
    }
}
