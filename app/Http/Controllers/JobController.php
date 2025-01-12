<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\View\View;

class JobController extends Controller
{
    private $rapidApiKey;
    private $rapidApiHost;
    private $defaultCompanies = ['EPF','Google', 'Apple', 'Microsoft', 'Amazon', 'Meta', 'Pornhub', 'Netflix', 'Tesla', 'SpaceX', ];
    private $employment_types = [
        '' => 'Tous les types',
        'FULLTIME' => 'Temps plein',
        'PARTTIME' => 'Temps partiel',
        'CONTRACTOR' => 'Freelance',
        'INTERN' => 'Stage'
    ];

    public function __construct()
    {
        $this->rapidApiHost = env('RAPID_API_HOST', 'jsearch.p.rapidapi.com');
        $this->rapidApiKey = env('RAPID_API_KEY', '202efbc259msh91577d56fc51aaap1c0060jsnc08bf3daad1a');
    }

    public function index(Request $request): View
    {
        $query = $request->get('query', '');
        $location = $request->get('location', '');
        $employmentType = $request->get('employment_type', '');
        $page = $request->get('page', 1);

        $jobs = [];
        $error = null;

        try {
            // Construire la requête de recherche
            $searchQuery = $query;
            if (empty($searchQuery)) {
                // Si pas de recherche, utiliser une entreprise aléatoire
                $company = $this->defaultCompanies[array_rand($this->defaultCompanies)];
                $searchQuery = "developer {$company}";
            }
            if ($location) {
                $searchQuery .= " in {$location}";
            }

            $response = Http::withHeaders([
                'X-RapidAPI-Host' => $this->rapidApiHost,
                'X-RapidAPI-Key' => $this->rapidApiKey
            ])->get('https://jsearch.p.rapidapi.com/search', [
                'query' => $searchQuery,
                'page' => (string)$page,
                'num_pages' => '1',
                'employment_types' => $employmentType ? [$employmentType] : null
            ]);

            if ($response->successful()) {
                $data = $response->json();
                $jobs = $data['data'] ?? [];
            } else {
                Log::error('Job search API error: ' . $response->body());
                $error = 'Une erreur est survenue lors de la recherche d\'emplois.';
            }
        } catch (\Exception $e) {
            Log::error('Job search error: ' . $e->getMessage());
            $error = 'Une erreur est survenue lors de la recherche d\'emplois.';
        }

        return view('jobs.index', [
            'jobs' => $jobs,
            'query' => $query,
            'location' => $location,
            'employment_type' => $employmentType,
            'employment_types' => $this->employment_types,
            'page' => $page,
            'error' => $error
        ]);
    }

    public function show($id)
    {
        try {
            $response = Http::withHeaders([
                'X-RapidAPI-Host' => $this->rapidApiHost,
                'X-RapidAPI-Key' => $this->rapidApiKey
            ])->get('https://jsearch.p.rapidapi.com/job-details', [
                'job_id' => $id
            ]);

            if ($response->successful()) {
                $data = $response->json();
                $job = $data['data'][0] ?? null;

                if ($job) {
                    return view('jobs.show', compact('job'));
                }
            }

            return redirect()->route('jobs.index')
                ->with('error', 'L\'offre d\'emploi n\'a pas été trouvée.');
        } catch (\Exception $e) {
            Log::error('Job details error: ' . $e->getMessage());
            return redirect()->route('jobs.index')
                ->with('error', 'Une erreur est survenue lors de la récupération des détails de l\'emploi.');
        }
    }
}
