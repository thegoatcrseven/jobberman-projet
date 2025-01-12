<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Détails de l\'offre') }}
            </h2>
            <a href="{{ route('jobs.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                Retour aux offres
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="mb-6">
                        <h1 class="text-3xl font-bold text-gray-900">{{ $job['job_title'] ?? 'Titre non disponible' }}</h1>
                        <div class="mt-2 flex items-center">
                            @if(isset($job['employer_logo']) && $job['employer_logo'])
                                <img src="{{ $job['employer_logo'] }}" alt="{{ $job['employer_name'] ?? 'Logo entreprise' }}" class="h-8 w-8 object-contain mr-2">
                            @endif
                            <p class="text-xl text-gray-600">{{ $job['employer_name'] ?? 'Entreprise non spécifiée' }}</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h3 class="font-semibold text-gray-700">Localisation</h3>
                            <p>{{ $job['job_city'] ?? 'Non spécifiée' }}{{ isset($job['job_country']) ? ', ' . $job['job_country'] : '' }}</p>
                            @if(isset($job['job_is_remote']) && $job['job_is_remote'])
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 mt-2">
                                    Remote
                                </span>
                            @endif
                        </div>

                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h3 class="font-semibold text-gray-700">Type de contrat</h3>
                            <p>{{ $job['job_employment_type'] ?? 'Non spécifié' }}</p>
                        </div>

                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h3 class="font-semibold text-gray-700">Date de publication</h3>
                            <p>{{ isset($job['job_posted_at_datetime_utc']) ? \Carbon\Carbon::parse($job['job_posted_at_datetime_utc'])->format('d/m/Y') : 'Non spécifiée' }}</p>
                        </div>
                    </div>

                    <div class="prose max-w-none">
                        <h2 class="text-2xl font-semibold mb-4">Description du poste</h2>
                        <div class="text-gray-600 space-y-4">
                            {!! nl2br(e($job['job_description'] ?? 'Aucune description disponible')) !!}
                        </div>

                        @if(isset($job['job_highlights']) && isset($job['job_highlights']['Qualifications']))
                            <h3 class="text-xl font-semibold mt-8 mb-4">Qualifications requises</h3>
                            <ul class="list-disc pl-5 text-gray-600">
                                @foreach($job['job_highlights']['Qualifications'] as $qualification)
                                    <li>{{ $qualification }}</li>
                                @endforeach
                            </ul>
                        @endif

                        @if(isset($job['job_highlights']) && isset($job['job_highlights']['Benefits']))
                            <h3 class="text-xl font-semibold mt-8 mb-4">Avantages</h3>
                            <ul class="list-disc pl-5 text-gray-600">
                                @foreach($job['job_highlights']['Benefits'] as $benefit)
                                    <li>{{ $benefit }}</li>
                                @endforeach
                            </ul>
                        @endif

                        @if(isset($job['job_required_skills']) && $job['job_required_skills'])
                            <h3 class="text-xl font-semibold mt-8 mb-4">Compétences requises</h3>
                            <div class="flex flex-wrap gap-2">
                                @foreach(explode(',', $job['job_required_skills']) as $skill)
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-gray-100 text-gray-800">
                                        {{ trim($skill) }}
                                    </span>
                                @endforeach
                            </div>
                        @endif
                    </div>

                    @if(isset($job['job_apply_link']) && $job['job_apply_link'])
                        <div class="mt-8">
                            <a href="{{ $job['job_apply_link'] }}" target="_blank" 
                               class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700">
                                Postuler à cette offre
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
