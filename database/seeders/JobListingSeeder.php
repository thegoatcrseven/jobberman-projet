<?php

namespace Database\Seeders;

use App\Models\JobListing;
use Illuminate\Database\Seeder;

class JobListingSeeder extends Seeder
{
    public function run(): void
    {
        $jobListings = [
            [
                'title' => 'Développeur Web Full-Stack',
                'description' => 'Nous recherchons un développeur web full-stack passionné pour rejoindre notre équipe dynamique.',
                'company_name' => 'TechStart',
                'location' => 'Paris',
                'type' => 'internship',
                'experience_level' => 'Junior',
                'salary_min' => 35000,
                'salary_max' => 45000,
                'required_skills' => ['PHP', 'Laravel', 'Vue.js', 'MySQL'],
                'application_deadline' => '2025-03-01',
                'is_active' => true
            ],
            [
                'title' => 'Assistant Marketing Digital',
                'description' => 'Rejoignez notre équipe marketing en alternance et participez à des projets passionnants.',
                'company_name' => 'Digital Marketing Pro',
                'location' => 'Lyon',
                'type' => 'apprenticeship',
                'experience_level' => 'Débutant',
                'salary_min' => 15000,
                'salary_max' => 18000,
                'required_skills' => ['SEO', 'Google Analytics', 'Social Media', 'Content Marketing'],
                'application_deadline' => '2025-02-15',
                'is_active' => true
            ],
            [
                'title' => 'Data Analyst Junior',
                'description' => 'Nous recherchons un analyste de données junior pour renforcer notre équipe data.',
                'company_name' => 'DataViz Corp',
                'location' => 'Bordeaux',
                'type' => 'job',
                'experience_level' => 'Junior',
                'salary_min' => 38000,
                'salary_max' => 42000,
                'required_skills' => ['Python', 'SQL', 'Power BI', 'Excel'],
                'application_deadline' => '2025-02-28',
                'is_active' => true
            ]
        ];

        foreach ($jobListings as $listing) {
            JobListing::create($listing);
        }
    }
}
