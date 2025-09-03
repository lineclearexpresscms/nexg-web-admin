<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'service_title',
        'service_category',
        'service_descriptions',
        'service_slug',
        'image',
        'file_image_count',
        'publish_date',
        'visibility',
    ];

    protected $casts = [
        'file_image_count' => 'integer',
        'publish_date' => 'date',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Validation rules
    public static function validationRules()
    {
        return [
            'service_title' => 'required|string|max:255',
            'service_category' => 'required|in:Security Printing,Digital Solutions',
            'service_descriptions' => 'required|string',
            'service_slug' => 'required|string|max:255|unique:services,service_slug',
            'image' => 'required|string|max:255',
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

    public function scopeByCategory($query, $category)
    {
        return $query->where('service_category', $category);
    }

    public function scopeSecurityPrinting($query)
    {
        return $query->where('service_category', 'Security Printing');
    }

    public function scopeDigitalSolutions($query)
    {
        return $query->where('service_category', 'Digital Solutions');
    }

    // Mutators
    public function setServiceTitleAttribute($value)
    {
        $this->attributes['service_title'] = $value;
        $this->attributes['service_slug'] = Str::slug($value);
    }

    // Helper methods
    public function isPublic()
    {
        return $this->visibility === 'public';
    }

    public function isSecurityPrinting()
    {
        return $this->service_category === 'Security Printing';
    }

    public function isDigitalSolutions()
    {
        return $this->service_category === 'Digital Solutions';
    }
}