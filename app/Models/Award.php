<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Award extends Model
{
    use HasFactory;

    protected $fillable = [
        'award_name',
        'award_description',
        'images',
    ];

    protected $casts = [
        'images' => 'array',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Validation rules
    public static function validationRules()
    {
        return [
            'award_name' => 'required|string|max:255',
            'award_description' => 'required|string',
            'images' => 'required|array|min:1',
            'images.*' => 'string|max:255',
        ];
    }

    // Helper methods
    public function getImagesCount()
    {
        return is_array($this->images) ? count($this->images) : 0;
    }

    public function hasImages()
    {
        return $this->getImagesCount() > 0;
    }

    public function getFirstImage()
    {
        return is_array($this->images) && count($this->images) > 0 ? $this->images[0] : null;
    }

    public function getDescriptionPreview($length = 150)
    {
        return strlen($this->award_description) > $length 
            ? substr($this->award_description, 0, $length) . '...' 
            : $this->award_description;
    }
}