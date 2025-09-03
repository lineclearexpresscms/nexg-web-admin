<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CorporateOverview extends Model
{
    use HasFactory;

    protected $table = 'corporate_overview';

    protected $fillable = [
        'title_heading',
        'descriptions',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Validation rules
    public static function validationRules()
    {
        return [
            'title_heading' => 'required|string|max:255',
            'descriptions' => 'required|string',
        ];
    }

    // Helper methods
    public function getDescriptionPreview($length = 150)
    {
        return strlen($this->descriptions) > $length 
            ? substr($this->descriptions, 0, $length) . '...' 
            : $this->descriptions;
    }
}