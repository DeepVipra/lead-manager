<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     * (Optional, but explicit is good practice)
     */
    protected $table = 'leads';

    /**
     * Mass assignable attributes.
     * Must match Excel import + DB columns.
     */
    protected $fillable = [
        'lead_date',
        'month',
        'client_name',
        'email',
        'contact_number',
        'country',
        'service',
        'website',
        'reply',
    ];

    /**
     * Attribute casting.
     * Ensures dates behave correctly.
     */
    protected $casts = [
        'lead_date' => 'date',
    ];
}
