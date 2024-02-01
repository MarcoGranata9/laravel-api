<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Project extends Model
{
    use HasFactory;
    
    use SoftDeletes;

    protected $fillable = ['type_id','title','slug','description','cover_img'];

    protected function setTitleAttribute($_title) {
        $this->attributes['title'] = $_title;
        $this->attributes['slug'] = Str::slug($_title);
    }

    public function type() {
        return $this->belongsTo(Type::class);
    }

    public function technologys() {
        return $this->belongsToMany(Technology::class);
    }
}