<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Company extends Model
{
    use HasFactory;

    protected $fillable = ['company_name', 'user_id', 'job_nature', 'start_date', 'end_date', 'is_current_working'];

    protected $casts = ['start_date' => 'date', 'end_date' => 'date', 'is_current_working' => 'bool'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getIsCurrentlyWorkingAttribute($value)
    {
        return !($value === 0);
    }
}
