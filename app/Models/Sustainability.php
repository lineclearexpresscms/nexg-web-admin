<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sustainability extends Model
{
    use HasFactory;

    protected $table = 'sustainability';

    protected $fillable = [
        'title',
        'descriptions',
        'image',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Validation rules
    public static function validationRules()
    {
        return [
            'title' => 'required|string|max:255',
            'descriptions' => 'required|string',
            'image' => 'required|string|max:255',
        ];
    }

    // Helper methods
    public function getDescriptionPreview($length = 150)
    {
        return strlen($this->descriptions) > $length 
            ? substr($this->descriptions, 0, $length) . '...' 
            : $this->descriptions;
    }

    public function hasImage()
    {
        return !empty($this->image);
    }
}