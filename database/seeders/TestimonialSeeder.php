<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Testimonial;

class TestimonialSeeder extends Seeder
{
    public function run(): void
    {
        $testimonials = [
            [
                'first_name' => 'Sophie',
                'last_name' => 'Martin',
                'rating' => 5,
                'comment' => "Grâce à cette plateforme, j'ai trouvé mon stage de rêve en développement web. Le processus était simple et efficace, et j'ai pu utiliser les modèles de CV proposés qui ont vraiment fait la différence !",
                'job_type' => 'internship',
                'company_name' => 'TechStart',
                'position' => 'Développeuse Web Full-Stack',
                'is_featured' => true
            ],
            [
                'first_name' => 'Thomas',
                'last_name' => 'Dubois',
                'rating' => 4,
                'comment' => "J'ai décroché mon alternance en marketing digital après seulement 2 semaines de recherche. Les conseils pour personnaliser mon CV étaient très pertinents.",
                'job_type' => 'apprenticeship',
                'company_name' => 'Digital Marketing Pro',
                'position' => 'Assistant Marketing Digital',
                'is_featured' => true
            ],
            [
                'first_name' => 'Emma',
                'last_name' => 'Bernard',
                'rating' => 5,
                'comment' => "Un grand merci ! J'ai trouvé mon premier emploi en tant que data analyst. Le format du CV moderne a vraiment plu aux recruteurs.",
                'job_type' => 'job',
                'company_name' => 'DataViz Corp',
                'position' => 'Data Analyst Junior',
                'is_featured' => true
            ],
            [
                'first_name' => 'Lucas',
                'last_name' => 'Petit',
                'rating' => 5,
                'comment' => "Excellente expérience ! La plateforme m'a permis de créer un CV professionnel qui a attiré l'attention de plusieurs entreprises. J'ai finalement décroché un super stage en design UI/UX.",
                'job_type' => 'internship',
                'company_name' => 'Creative Design',
                'position' => 'UI/UX Designer Stagiaire',
                'is_featured' => false
            ],
            [
                'first_name' => 'Julie',
                'last_name' => 'Moreau',
                'rating' => 4,
                'comment' => "La recherche d'alternance peut être stressante, mais grâce aux outils proposés ici, j'ai pu me concentrer sur l'essentiel. Résultat : une alternance en comptabilité dans un grand cabinet !",
                'job_type' => 'apprenticeship',
                'company_name' => 'Compta & Co',
                'position' => 'Assistante Comptable en Alternance',
                'is_featured' => false
            ]
        ];

        foreach ($testimonials as $testimonial) {
            Testimonial::create($testimonial);
        }
    }
}
