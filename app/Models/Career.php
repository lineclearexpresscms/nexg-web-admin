<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Career extends Model
{
    use HasFactory;

    protected $fillable = [
        'job_title',
        'job_description',
        'publish_date',
        'is_active',
        'visibility',
    ];

    protected $casts = [
        'publish_date' => 'date',
        'is_active' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Validation rules
    public static function validationRules()
    {
        return [
            'job_title' => 'required|string|max:255',
            'job_description' => 'required|string',
            'publish_date' => 'required|date',
            'is_active' => 'boolean',
            'visibility' => 'required|in:public,private,draft',
        ];
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopePublic($query)
    {
        return $query->where('visibility', 'public');
    }

    public function scopePublished($query)
    {
        return $query->where('publish_date', '<=', now());
    }

    public function scopeAvailable($query)
    {
        return $query->active()->public()->published();
    }

    // Helper methods
    public function isPublic()
    {
        return $this->visibility === 'public';
    }

    public function isPublished()
    {
        return $this->publish_date <= now();
    }

    public function isAvailable()
    {
        return $this->is_active && $this->isPublic() && $this->isPublished();
    }

    public function getDescriptionPreview($length = 150)
    {
        return strlen($this->job_description) > $length 
            ? substr($this->job_description, 0, $length) . '...' 
            : $this->job_description;
    }
}