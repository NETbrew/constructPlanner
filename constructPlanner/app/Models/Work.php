<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Work extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'active'];

    public function user() {
        return $this->belongsTo(User::class)->withDefault();
    }
    public function type() {
        return $this->belongsTo(Type::class)->withDefault();
    }

}
