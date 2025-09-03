<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Footer extends Model
{
    use HasFactory;

    protected $table = 'footer';

    protected $fillable = [
        'footer_title',
        'footer_url',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Validation rules
    public static function validationRules()
    {
        return [
            'footer_title' => 'required|string|max:255',
            'footer_url' => 'required|url|max:500',
        ];
    }

    // Scopes
    public function scopeOrdered($query)
    {
        return $query->orderBy('footer_title');
    }

    // Helper methods
    public function isExternalLink()
    {
        return !str_starts_with($this->footer_url, config('app.url'));
    }
}