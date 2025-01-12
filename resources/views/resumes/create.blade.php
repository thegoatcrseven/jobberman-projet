<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Créer un nouveau CV') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form method="POST" action="{{ route('resumes.store') }}" class="space-y-6">
                        @csrf

                        <!-- Informations de base -->
                        <div>
                            <x-input-label for="title" :value="__('Titre du CV')" />
                            <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" :value="old('title')" required />
                            <x-input-error :messages="$errors->get('title')" class="mt-2" />
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <x-input-label for="first_name" :value="__('Prénom')" />
                                <x-text-input id="first_name" name="first_name" type="text" class="mt-1 block w-full" :value="old('first_name')" required />
                                <x-input-error :messages="$errors->get('first_name')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="last_name" :value="__('Nom')" />
                                <x-text-input id="last_name" name="last_name" type="text" class="mt-1 block w-full" :value="old('last_name')" required />
                                <x-input-error :messages="$errors->get('last_name')" class="mt-2" />
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <x-input-label for="email" :value="__('Email')" />
                                <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email')" required />
                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="phone" :value="__('Téléphone')" />
                                <x-text-input id="phone" name="phone" type="tel" class="mt-1 block w-full" :value="old('phone')" />
                                <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                            </div>
                        </div>

                        <div>
                            <x-input-label for="address" :value="__('Adresse')" />
                            <x-text-input id="address" name="address" type="text" class="mt-1 block w-full" :value="old('address')" />
                            <x-input-error :messages="$errors->get('address')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="summary" :value="__('Résumé')" />
                            <textarea id="summary" name="summary" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('summary') }}</textarea>
                            <x-input-error :messages="$errors->get('summary')" class="mt-2" />
                        </div>

                        <!-- Formation -->
                        <div class="space-y-4">
                            <h3 class="text-lg font-medium">Formation</h3>
                            <div class="space-y-4 p-4 border rounded-lg">
                                <div>
                                    <x-input-label for="education_institution" :value="__('Institution')" />
                                    <x-text-input id="education_institution" name="education[0][institution]" type="text" class="mt-1 block w-full" :value="old('education.0.institution')" required />
                                </div>
                                <div>
                                    <x-input-label for="education_degree" :value="__('Diplôme')" />
                                    <x-text-input id="education_degree" name="education[0][degree]" type="text" class="mt-1 block w-full" :value="old('education.0.degree')" required />
                                </div>
                                <div>
                                    <x-input-label for="education_field" :value="__('Domaine d\'études')" />
                                    <x-text-input id="education_field" name="education[0][field]" type="text" class="mt-1 block w-full" :value="old('education.0.field')" required />
                                </div>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <x-input-label for="education_start_date" :value="__('Date de début')" />
                                        <x-text-input id="education_start_date" name="education[0][start_date]" type="date" class="mt-1 block w-full" :value="old('education.0.start_date')" required />
                                    </div>
                                    <div>
                                        <x-input-label for="education_end_date" :value="__('Date de fin')" />
                                        <x-text-input id="education_end_date" name="education[0][end_date]" type="date" class="mt-1 block w-full" :value="old('education.0.end_date')" />
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Expérience -->
                        <div class="space-y-4">
                            <h3 class="text-lg font-medium">Expérience professionnelle</h3>
                            <div class="space-y-4 p-4 border rounded-lg">
                                <div>
                                    <x-input-label for="experience_company" :value="__('Entreprise')" />
                                    <x-text-input id="experience_company" name="experience[0][company]" type="text" class="mt-1 block w-full" :value="old('experience.0.company')" required />
                                </div>
                                <div>
                                    <x-input-label for="experience_position" :value="__('Poste')" />
                                    <x-text-input id="experience_position" name="experience[0][position]" type="text" class="mt-1 block w-full" :value="old('experience.0.position')" required />
                                </div>
                                <div>
                                    <x-input-label for="experience_description" :value="__('Description')" />
                                    <textarea id="experience_description" name="experience[0][description]" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>{{ old('experience.0.description') }}</textarea>
                                </div>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <x-input-label for="experience_start_date" :value="__('Date de début')" />
                                        <x-text-input id="experience_start_date" name="experience[0][start_date]" type="date" class="mt-1 block w-full" :value="old('experience.0.start_date')" required />
                                    </div>
                                    <div>
                                        <x-input-label for="experience_end_date" :value="__('Date de fin')" />
                                        <x-text-input id="experience_end_date" name="experience[0][end_date]" type="date" class="mt-1 block w-full" :value="old('experience.0.end_date')" />
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Compétences -->
                        <div>
                            <x-input-label for="skills" :value="__('Compétences (séparées par des virgules)')" />
                            <x-text-input id="skills" name="skills" type="text" class="mt-1 block w-full" :value="old('skills')" placeholder="PHP, Laravel, JavaScript, etc." />
                            <x-input-error :messages="$errors->get('skills')" class="mt-2" />
                        </div>

                        <!-- Langues -->
                        <div class="space-y-4">
                            <h3 class="text-lg font-medium">Langues</h3>
                            <div class="flex gap-4">
                                <div class="flex-1">
                                    <x-input-label for="language" :value="__('Langue')" />
                                    <x-text-input id="language" name="languages[]" type="text" class="mt-1 block w-full" :value="old('languages.0')" />
                                </div>
                            </div>
                        </div>

                        <!-- Certifications -->
                        <div>
                            <x-input-label for="certifications" :value="__('Certifications (séparées par des virgules)')" />
                            <x-text-input id="certifications" name="certifications" type="text" class="mt-1 block w-full" :value="old('certifications')" placeholder="AWS Certified, CISCO, etc." />
                            <x-input-error :messages="$errors->get('certifications')" class="mt-2" />
                        </div>

                        <!-- Template -->
                        <div>
                            <x-input-label for="template" :value="__('Template')" />
                            <select id="template" name="template" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                <option value="modern" {{ old('template') === 'modern' ? 'selected' : '' }}>Modern</option>
                                <option value="classic" {{ old('template') === 'classic' ? 'selected' : '' }}>Classic</option>
                                <option value="minimal" {{ old('template') === 'minimal' ? 'selected' : '' }}>Minimal</option>
                            </select>
                            <x-input-error :messages="$errors->get('template')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button>
                                {{ __('Créer le CV') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
