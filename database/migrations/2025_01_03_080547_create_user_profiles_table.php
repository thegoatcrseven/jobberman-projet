<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('user_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            // Slide 1: Introduction
            $table->string('full_name')->nullable();
            $table->string('profile_photo')->nullable();
            $table->string('professional_title')->nullable();
            $table->text('professional_objective')->nullable();
            
            // Slide 2: Academic Background
            $table->string('current_education')->nullable();
            $table->string('academic_level')->nullable();
            $table->text('academic_strengths')->nullable();
            
            // Slide 3: Professional Experience
            $table->text('professional_experiences')->nullable();
            $table->text('projects_and_internships')->nullable();
            
            // Slide 4: Technical Skills
            $table->json('technical_skills')->nullable();
            $table->json('tools')->nullable();
            $table->text('methodologies')->nullable();
            
            // Slide 5: Projects
            $table->json('main_projects')->nullable();
            
            // Slide 6: Hobbies
            $table->text('hobbies')->nullable();
            $table->text('interests')->nullable();
            
            // Slide 7: Contact
            $table->string('professional_email')->nullable();
            $table->string('linkedin_url')->nullable();
            $table->string('portfolio_url')->nullable();
            $table->string('github_url')->nullable();
            
            // Progress tracking
            $table->integer('completion_step')->default(1);
            $table->boolean('is_completed')->default(false);
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_profiles');
    }
};
