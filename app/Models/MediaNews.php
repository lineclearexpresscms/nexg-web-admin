<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class MediaNews extends Model
{
    use HasFactory;

    protected $table = 'media_news';

    protected $fillable = [
        'news_title',
        'news_descriptions',
        'news_slug',
        'news_category',
        'news_image_cover',
        'year',
        'image_gallery',
        'file_image_count',
        'publish_date',
        'visibility',
    ];

    protected $casts = [
        'image_gallery' => 'array',
        'file_image_count' => 'integer',
        'publish_date' => 'date',
        'year' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Validation rules
    public static function validationRules()
    {
        return [
            'news_title' => 'required|string|max:255',
            'news_descriptions' => 'required|string',
            'news_slug' => 'required|string|max:255|unique:media_news,news_slug',
            'news_category' => 'required|string|max:100',
            'news_image_cover' => 'required|string|max:255',
            'year' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'image_gallery' => 'nullable|array',
            'file_image_count' => 'integer|min:0',
            'publish_date' => 'required|date',
            'visibility' => 'required|in:public,private,draft',
        ];
    }

    // Scopes
    public function scopePublic($query)
    {
        return $query->where('visibility', 'public');
    }

    public function scopeByYear($query, $year)
    {
        return $query->where('year', $year);
    }

    public function scopeByCategory($query, $category)
    {
        return $query->where('news_category', $category);
    }

    // Mutators
    public function setNewsTitleAttribute($value)
    {
        $this->attributes['news_title'] = $value;
        $this->attributes['news_slug'] = Str::slug($value);
    }

    // Helper methods
    public function isPublic()
    {
        return $this->visibility === 'public';
    }

    public function getImageGalleryCount()
    {
        return is_array($this->image_gallery) ? count($this->image_gallery) : 0;
    }
}