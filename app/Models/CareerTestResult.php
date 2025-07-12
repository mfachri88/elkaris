<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CareerTestResult extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'software_developer',
        'data_scientist',
        'network_engineer',
        'ui_ux_designer',
        'cybersecurity_analyst',
        'it_consultant',
        'result',
        'metadata'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}