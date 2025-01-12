<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tableau de bord') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Section des témoignages -->
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg mb-6">
                <div class="p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-6">Témoignages de réussite</h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($testimonials as $testimonial)
                            <!-- Carte de témoignage -->
                            <div x-data="{ open: false }" class="relative">
                                <div @click="open = true" 
                                     class="bg-white rounded-lg border shadow-sm hover:shadow-md transition-all duration-300 cursor-pointer">
                                    <div class="p-6">
                                        <!-- En-tête avec avatar et nom -->
                                        <div class="flex items-center mb-4">
                                            <div class="flex-shrink-0">
                                                @if($testimonial->avatar)
                                                    <img class="h-12 w-12 rounded-full object-cover" 
                                                         src="{{ asset('storage/' . $testimonial->avatar) }}" 
                                                         alt="{{ $testimonial->full_name }}">
                                                @else
                                                    <div class="h-12 w-12 rounded-full bg-blue-100 flex items-center justify-center">
                                                        <span class="text-blue-600 font-medium text-lg">
                                                            {{ substr($testimonial->first_name, 0, 1) }}{{ substr($testimonial->last_name, 0, 1) }}
                                                        </span>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="ml-4">
                                                <h4 class="text-lg font-medium text-gray-900">
                                                    {{ $testimonial->full_name }}
                                                </h4>
                                                <p class="text-sm text-gray-500">
                                                    {{ $testimonial->position }} chez {{ $testimonial->company_name }}
                                                </p>
                                            </div>
                                        </div>

                                        <!-- Note en étoiles -->
                                        <div class="flex items-center mb-4">
                                            @for($i = 1; $i <= 5; $i++)
                                                @if($i <= $testimonial->rating)
                                                    <svg class="h-5 w-5 text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                    </svg>
                                                @else
                                                    <svg class="h-5 w-5 text-gray-300" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                    </svg>
                                                @endif
                                            @endfor
                                        </div>

                                        <!-- Type d'emploi -->
                                        <div class="mb-4">
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                                {{ $testimonial->job_type === 'job' ? 'bg-green-100 text-green-800' : 
                                                   ($testimonial->job_type === 'internship' ? 'bg-blue-100 text-blue-800' : 
                                                   'bg-purple-100 text-purple-800') }}">
                                                {{ $testimonial->job_type === 'job' ? 'Emploi' : 
                                                   ($testimonial->job_type === 'internship' ? 'Stage' : 'Alternance') }}
                                            </span>
                                        </div>

                                        <!-- Commentaire (tronqué) -->
                                        <p class="text-gray-600 text-sm line-clamp-3">
                                            {{ $testimonial->comment }}
                                        </p>
                                    </div>
                                </div>

                                <!-- Modal avec détails complets -->
                                <div x-show="open" 
                                     class="fixed inset-0 bg-gray-500 bg-opacity-75 flex items-center justify-center z-50"
                                     x-transition:enter="transition ease-out duration-300"
                                     x-transition:enter-start="opacity-0"
                                     x-transition:enter-end="opacity-100"
                                     x-transition:leave="transition ease-in duration-200"
                                     x-transition:leave-start="opacity-100"
                                     x-transition:leave-end="opacity-0"
                                     style="display: none;">
                                    <div class="bg-white rounded-lg shadow-xl max-w-2xl w-full mx-4" 
                                         @click.away="open = false">
                                        <div class="p-6">
                                            <!-- En-tête du modal -->
                                            <div class="flex items-center justify-between mb-6">
                                                <h3 class="text-xl font-medium text-gray-900">
                                                    Parcours de {{ $testimonial->full_name }}
                                                </h3>
                                                <button @click="open = false" class="text-gray-400 hover:text-gray-500">
                                                    <span class="sr-only">Fermer</span>
                                                    <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                    </svg>
                                                </button>
                                            </div>

                                            <!-- Contenu du modal -->
                                            <div class="space-y-6">
                                                <!-- Informations sur le poste -->
                                                <div>
                                                    <h4 class="font-medium text-gray-900">Poste obtenu</h4>
                                                    <div class="mt-2 bg-gray-50 rounded-lg p-4">
                                                        <p class="text-sm text-gray-600">
                                                            {{ $testimonial->position }} chez {{ $testimonial->company_name }}
                                                        </p>
                                                        <p class="text-sm text-gray-500 mt-1">
                                                            Via une offre de {{ $testimonial->job_type === 'job' ? 'travail' : 
                                                               ($testimonial->job_type === 'internship' ? 'stage' : 'alternance') }}
                                                        </p>
                                                    </div>
                                                </div>

                                                <!-- Annonce liée -->
                                                @if($testimonial->job_listing_id && $testimonial->jobListing)
                                                <div>
                                                    <h4 class="font-medium text-gray-900">Annonce consultée</h4>
                                                    <div class="mt-2">
                                                        <a href="{{ route('job-listings.show', $testimonial->jobListing) }}" 
                                                           class="text-blue-600 hover:text-blue-700 text-sm">
                                                            {{ $testimonial->jobListing->title }}
                                                        </a>
                                                    </div>
                                                </div>
                                                @endif

                                                <!-- CV utilisé -->
                                                @if($testimonial->resume_used)
                                                <div>
                                                    <h4 class="font-medium text-gray-900">CV utilisé</h4>
                                                    <div class="mt-2">
                                                        <p class="text-sm text-gray-600">
                                                            {{ $testimonial->resume_used }}
                                                        </p>
                                                    </div>
                                                </div>
                                                @endif

                                                <!-- Témoignage complet -->
                                                <div>
                                                    <h4 class="font-medium text-gray-900">Témoignage complet</h4>
                                                    <p class="mt-2 text-gray-600">
                                                        {{ $testimonial->comment }}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Autres sections du dashboard -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-medium mb-4">{{ __('Bienvenue') }} {{ Auth::user()->name }} !</h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <!-- Profile Card -->
                        <div class="bg-white p-6 rounded-lg shadow">
                            <h4 class="font-semibold mb-2">{{ __('Mon Profil') }}</h4>
                            <p class="text-gray-600 mb-4">{{ __('Gérez vos informations personnelles et professionnelles') }}</p>
                            <a href="{{ route('profile.edit') }}" 
                               class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                                {{ __('Modifier mon profil') }}
                            </a>
                        </div>

                        <!-- Jobs Card -->
                        <div class="bg-white p-6 rounded-lg shadow">
                            <h4 class="font-semibold mb-2">{{ __('Offres d\'emploi') }}</h4>
                            <p class="text-gray-600 mb-4">{{ __('Parcourez les dernières offres d\'emploi') }}</p>
                            <a href="{{ route('jobs.index') }}" 
                               class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                                {{ __('Voir les offres') }}
                            </a>
                        </div>

                        <!-- Resume Card -->
                        <div class="bg-white p-6 rounded-lg shadow">
                            <h4 class="font-semibold mb-2">{{ __('Mes CV') }}</h4>
                            <p class="text-gray-600 mb-4">{{ __('Gérez vos CV et candidatures') }}</p>
                            <a href="{{ route('resumes.index') }}" 
                               class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                                {{ __('Gérer mes CV') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.2/dist/alpine.min.js" defer></script>
    @endpush
</x-app-layout>
