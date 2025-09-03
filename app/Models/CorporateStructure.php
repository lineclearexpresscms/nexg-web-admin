<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CorporateStructure extends Model
{
    use HasFactory;

    protected $table = 'corporate_structure';

    protected $fillable = [
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
}