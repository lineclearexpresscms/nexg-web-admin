<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeadershipTeamMember extends Model
{
    use HasFactory;

    protected $fillable = [
        'leadership_team_id',
        'member_name',
        'member_position',
        'member_description',
        'member_image',
        'display_order',
        'is_active',
    ];

    protected $casts = [
        'leadership_team_id' => 'integer',
        'display_order' => 'integer',
        'is_active' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Validation rules
    public static function validationRules()
    {
        return [
            'leadership_team_id' => 'required|exists:leadership_teams,id',
            'member_name' => 'required|string|max:255',
            'member_position' => 'required|string|max:255',
            'member_description' => 'nullable|string',
            'member_image' => 'nullable|string|max:255',
            'display_order' => 'integer|min:0',
            'is_active' => 'boolean',
        ];
    }

    // Relationships
    public function leadershipTeam()
    {
        return $this->belongsTo(LeadershipTeam::class);
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('display_order');
    }

    public function scopeByTeam($query, $teamId)
    {
        return $query->where('leadership_team_id', $teamId);
    }

    // Helper methods
    public function hasImage()
    {
        return !empty($this->member_image);
    }
}