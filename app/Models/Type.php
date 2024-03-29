<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Type extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug',];

    public function projects() {
        return $this->hasMany(Project::class);
    }

    protected function setNameAttribute($_name) {
        $this->attributes['name'] = $_name;
        $this->attributes['slug'] = Str::slug($_name);
    }

}
