<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;

class UserProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'full_name',
        'profile_photo',
        'professional_title',
        'professional_objective',
        'current_education',
        'academic_level',
        'academic_strengths',
        'professional_experiences',
        'projects_internships',
        'technical_skills',
        'tools',
        'methodologies',
        'projects',
        'hobbies',
        'interests',
        'professional_email',
        'linkedin',
        'portfolio',
        'github',
        'completion_step',
        'is_completed'
    ];

    protected $casts = [
        'technical_skills' => 'array',
        'tools' => 'array',
        'projects' => 'array',
        'is_completed' => 'boolean'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
