<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ $resume->title }}
            </h2>
            <div class="flex space-x-4">
                <a href="{{ route('resumes.edit', $resume) }}" 
                   class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700">
                    Modifier
                </a>
                <a href="{{ route('resumes.download', $resume) }}" 
                   class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700">
                    Télécharger PDF
                </a>
                <form method="POST" action="{{ route('resumes.destroy', $resume) }}" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700"
                            onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce CV ?')">
                        Supprimer
                    </button>
                </form>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <!-- Informations personnelles -->
                    <div class="mb-8">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Informations personnelles</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <p class="text-sm font-medium text-gray-500">Nom complet</p>
                                <p class="mt-1">{{ $resume->first_name }} {{ $resume->last_name }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Email</p>
                                <p class="mt-1">{{ $resume->email }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Téléphone</p>
                                <p class="mt-1">{{ $resume->phone }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Adresse</p>
                                <p class="mt-1">{{ $resume->address }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Résumé -->
                    @if($resume->summary)
                    <div class="mb-8">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Résumé</h3>
                        <p class="text-gray-600">{{ $resume->summary }}</p>
                    </div>
                    @endif

                    <!-- Formation -->
                    @if($resume->education && count($resume->education) > 0)
                    <div class="mb-8">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Formation</h3>
                        @foreach($resume->education as $education)
                        <div class="mb-4 last:mb-0">
                            <h4 class="font-medium">{{ $education['institution'] }}</h4>
                            <p class="text-gray-600">{{ $education['degree'] }} en {{ $education['field'] }}</p>
                            <p class="text-sm text-gray-500">
                                {{ \Carbon\Carbon::parse($education['start_date'])->format('M Y') }} - 
                                {{ isset($education['end_date']) ? \Carbon\Carbon::parse($education['end_date'])->format('M Y') : 'Présent' }}
                            </p>
                        </div>
                        @endforeach
                    </div>
                    @endif

                    <!-- Expérience -->
                    @if($resume->experience && count($resume->experience) > 0)
                    <div class="mb-8">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Expérience professionnelle</h3>
                        @foreach($resume->experience as $experience)
                        <div class="mb-4 last:mb-0">
                            <h4 class="font-medium">{{ $experience['position'] }}</h4>
                            <p class="text-gray-600">{{ $experience['company'] }}</p>
                            <p class="text-sm text-gray-500">
                                {{ \Carbon\Carbon::parse($experience['start_date'])->format('M Y') }} - 
                                {{ isset($experience['end_date']) ? \Carbon\Carbon::parse($experience['end_date'])->format('M Y') : 'Présent' }}
                            </p>
                            <p class="mt-2">{{ $experience['description'] }}</p>
                        </div>
                        @endforeach
                    </div>
                    @endif

                    <!-- Compétences -->
                    @if($resume->skills && count($resume->skills) > 0)
                    <div class="mb-8">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Compétences</h3>
                        <div class="flex flex-wrap gap-2">
                            @foreach($resume->skills as $skill)
                            <span class="inline-flex items-center px-3 py-0.5 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                                {{ $skill }}
                            </span>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    <!-- Langues -->
                    @if($resume->languages && count($resume->languages) > 0)
                    <div class="mb-8">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Langues</h3>
                        <div class="flex flex-wrap gap-2">
                            @foreach($resume->languages as $language)
                            <span class="inline-flex items-center px-3 py-0.5 rounded-full text-sm font-medium bg-green-100 text-green-800">
                                {{ $language }}
                            </span>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    <!-- Certifications -->
                    @if($resume->certifications && count($resume->certifications) > 0)
                    <div class="mb-8">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Certifications</h3>
                        <div class="flex flex-wrap gap-2">
                            @foreach($resume->certifications as $certification)
                            <span class="inline-flex items-center px-3 py-0.5 rounded-full text-sm font-medium bg-purple-100 text-purple-800">
                                {{ $certification }}
                            </span>
                            @endforeach
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
