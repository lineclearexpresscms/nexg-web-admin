<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class SlideBanner extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'valid_from',
        'valid_to',
        'image',
        'is_active',
        'link_url',
    ];

    protected $casts = [
        'valid_from' => 'date',
        'valid_to' => 'date',
        'is_active' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Validation rules
    public static function validationRules()
    {
        return [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'valid_from' => 'required|date',
            'valid_to' => 'required|date|after_or_equal:valid_from',
            'image' => 'required|string|max:255',
            'is_active' => 'boolean',
            'link_url' => 'nullable|url|max:500',
        ];
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeCurrentlyValid($query)
    {
        $today = Carbon::today();
        return $query->where('valid_from', '<=', $today)
                    ->where('valid_to', '>=', $today);
    }

    // Helper methods
    public function isCurrentlyValid()
    {
        $today = Carbon::today();
        return $this->valid_from <= $today && $this->valid_to >= $today;
    }
}