<?php

namespace App\Models;

use Illuminate\Support\Str; // Add this line for importing the Str class
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['title', 'body', 'image', 'tags', 'spiciness_level', 'is_vegan', 'user_id', 'price'];

    protected function snippet(): Attribute {
        return Attribute::get(function (){
            return explode("\n\n", $this->body)[0];
        });
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function getSnippetAttribute()
    {
        return Str::limit(strip_tags($this->body), 150);
    }

    public function getSpicinessLevelAttribute()
{
    return $this->attributes['is_spicy'];
}
}
