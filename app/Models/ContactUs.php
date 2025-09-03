<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactUs extends Model
{
    use HasFactory;

    protected $table = 'contact_us';

    protected $fillable = [
        'company_address',
        'company_email_address',
        'company_telephone_number',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Validation rules
    public static function validationRules()
    {
        return [
            'company_address' => 'required|string',
            'company_email_address' => 'required|email|max:255',
            'company_telephone_number' => 'required|string|max:50',
        ];
    }

    // Helper methods
    public function getFormattedAddress()
    {
        return nl2br(e($this->company_address));
    }

    public function getFormattedPhone()
    {
        // Remove any non-digit characters for tel: link
        $cleanPhone = preg_replace('/[^0-9+]/', '', $this->company_telephone_number);
        return $cleanPhone;
    }
}