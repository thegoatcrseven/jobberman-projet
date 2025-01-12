@php
use Illuminate\Support\Str;
@endphp

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Offres d\'emploi') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <!-- Formulaire de recherche -->
                <form action="{{ route('jobs.index') }}" method="GET" class="mb-8">
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                        <div>
                            <label for="query" class="block text-sm font-medium text-gray-700">Mot-clé</label>
                            <input type="text" name="query" id="query" value="{{ request('query') }}" 
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                   placeholder="Ex: Développeur PHP">
                        </div>
                        <div>
                            <label for="location" class="block text-sm font-medium text-gray-700">Lieu</label>
                            <input type="text" name="location" id="location" value="{{ request('location') }}"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                   placeholder="Ex: Paris">
                        </div>
                        <div>
                            <label for="employment_type" class="block text-sm font-medium text-gray-700">Type de contrat</label>
                            <select name="employment_type" id="employment_type"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                <option value="">Tous les types</option>
                                <option value="FULLTIME" {{ request('employment_type') === 'FULLTIME' ? 'selected' : '' }}>Temps plein</option>
                                <option value="PARTTIME" {{ request('employment_type') === 'PARTTIME' ? 'selected' : '' }}>Temps partiel</option>
                                <option value="CONTRACTOR" {{ request('employment_type') === 'CONTRACTOR' ? 'selected' : '' }}>Freelance</option>
                                <option value="INTERN" {{ request('employment_type') === 'INTERN' ? 'selected' : '' }}>Stage</option>
                            </select>
                        </div>
                        <div class="flex items-end">
                            <button type="submit" class="w-full bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700">
                                Rechercher
                            </button>
                        </div>
                    </div>
                </form>

                @if(isset($error))
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                        <span class="block sm:inline">{{ $error }}</span>
                    </div>
                @endif

                <div class="space-y-6">
                    @forelse($jobs as $job)
                        <div class="border rounded-lg p-6 hover:shadow-lg transition-shadow">
                            <div class="flex justify-between items-start">
                                <div class="flex-1">
                                    <h3 class="text-xl font-semibold text-gray-900">
                                        <a href="{{ route('jobs.show', $job['job_id']) }}" class="hover:text-indigo-600">
                                            {{ $job['job_title'] }}
                                        </a>
                                    </h3>
                                    <div class="mt-2">
                                        <p class="text-gray-600">{{ $job['employer_name'] }}</p>
                                        <p class="text-gray-500 text-sm mt-1">
                                            {{ $job['job_city'] }}{{ isset($job['job_country']) ? ', ' . $job['job_country'] : '' }}
                                            @if(isset($job['job_is_remote']) && $job['job_is_remote'])
                                                <span class="ml-2 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                    Remote
                                                </span>
                                            @endif
                                        </p>
                                    </div>
                                    <div class="mt-4">
                                        <p class="text-gray-700">
                                            {{ Str::limit(strip_tags($job['job_description']), 200) }}
                                        </p>
                                    </div>
                                </div>
                                @if(isset($job['employer_logo']))
                                    <img src="{{ $job['employer_logo'] }}" alt="{{ $job['employer_name'] }}" class="h-12 w-12 object-contain ml-4">
                                @endif
                            </div>
                            <div class="mt-4 flex items-center justify-between">
                                <div class="flex items-center space-x-4">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                                        {{ $job['job_employment_type'] ?? 'Non spécifié' }}
                                    </span>
                                    @if(isset($job['job_posted_at_datetime']))
                                        <span class="text-sm text-gray-500">
                                            Publié le {{ \Carbon\Carbon::parse($job['job_posted_at_datetime'])->format('d/m/Y') }}
                                        </span>
                                    @endif
                                </div>
                                <a href="{{ route('jobs.show', $job['job_id']) }}" 
                                   class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-indigo-600 bg-indigo-100 hover:bg-indigo-200">
                                    Voir l'offre
                                </a>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-12">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            <h3 class="mt-2 text-sm font-medium text-gray-900">Aucune offre trouvée</h3>
                            <p class="mt-1 text-sm text-gray-500">Essayez de modifier vos critères de recherche.</p>
                        </div>
                    @endforelse
                </div>

                @if(count($jobs) > 0)
                    <div class="mt-6 flex justify-between">
                        @if($page > 1)
                            <a href="{{ route('jobs.index', ['query' => request('query'), 'location' => request('location'), 'employment_type' => request('employment_type'), 'page' => $page - 1]) }}"
                               class="inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                                Page précédente
                            </a>
                        @endif
                        <a href="{{ route('jobs.index', ['query' => request('query'), 'location' => request('location'), 'employment_type' => request('employment_type'), 'page' => $page + 1]) }}"
                           class="ml-3 inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                            Page suivante
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
