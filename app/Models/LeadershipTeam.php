<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeadershipTeam extends Model
{
    use HasFactory;

    protected $fillable = [
        'team_name',
        'display_order',
    ];

    protected $casts = [
        'display_order' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Validation rules
    public static function validationRules()
    {
        return [
            'team_name' => 'required|string|max:255|unique:leadership_teams,team_name',
            'display_order' => 'integer|min:0',
        ];
    }

    // Relationships
    public function members()
    {
        return $this->hasMany(LeadershipTeamMember::class)
                    ->orderBy('display_order');
    }

    public function activeMembers()
    {
        return $this->hasMany(LeadershipTeamMember::class)
                    ->where('is_active', true)
                    ->orderBy('display_order');
    }

    // Scopes
    public function scopeOrdered($query)
    {
        return $query->orderBy('display_order');
    }

    // Helper methods
    public function getMembersCount()
    {
        return $this->members()->count();
    }

    public function getActiveMembersCount()
    {
        return $this->activeMembers()->count();
    }
}