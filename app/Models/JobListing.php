<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobListing extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'company_name',
        'location',
        'type',
        'experience_level',
        'salary_min',
        'salary_max',
        'required_skills',
        'application_deadline',
        'is_active'
    ];

    protected $casts = [
        'required_skills' => 'array',
        'application_deadline' => 'date',
        'is_active' => 'boolean',
        'salary_min' => 'decimal:2',
        'salary_max' => 'decimal:2'
    ];

    public function testimonials()
    {
        return $this->hasMany(Testimonial::class);
    }

    public function getSalaryRangeAttribute()
    {
        if ($this->salary_min && $this->salary_max) {
            return number_format($this->salary_min, 0) . '€ - ' . number_format($this->salary_max, 0) . '€';
        } elseif ($this->salary_min) {
            return 'À partir de ' . number_format($this->salary_min, 0) . '€';
        } elseif ($this->salary_max) {
            return "Jusqu'à " . number_format($this->salary_max, 0) . '€';
        }
        return 'Non spécifié';
    }
}
