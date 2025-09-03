<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class EventsActivities extends Model
{
    use HasFactory;

    protected $table = 'events_activities';

    protected $fillable = [
        'event_title',
        'event_descriptions',
        'event_slug',
        'event_category',
        'event_image_cover',
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
            'event_title' => 'required|string|max:255',
            'event_descriptions' => 'required|string',
            'event_slug' => 'required|string|max:255|unique:events_activities,event_slug',
            'event_category' => 'required|string|max:100',
            'event_image_cover' => 'required|string|max:255',
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
        return $query->where('event_category', $category);
    }

    // Mutators
    public function setEventTitleAttribute($value)
    {
        $this->attributes['event_title'] = $value;
        $this->attributes['event_slug'] = Str::slug($value);
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