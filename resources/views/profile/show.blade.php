@php
use Illuminate\Support\Facades\Auth;
$user = Auth::user();
@endphp

@extends('layouts.app')

@section('header')
    <div class="flex justify-between items-center">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Mon Profil') }}
        </h2>
        <a href="{{ route('profile.edit') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            {{ __('Modifier mon profil') }}
        </a>
    </div>
@endsection

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="flex items-start space-x-6">
                        <div class="flex-shrink-0">
                            @if($user && $user->avatar)
                                <img src="{{ Storage::url($user->avatar) }}" alt="Photo de profil" class="h-32 w-32 object-cover rounded-full">
                            @else
                                <div class="h-32 w-32 bg-gray-200 rounded-full flex items-center justify-center">
                                    <span class="text-gray-500 text-4xl">{{ $user ? substr($user->name, 0, 1) : '?' }}</span>
                                </div>
                            @endif
                        </div>
                        
                        <div class="flex-1">
                            <h1 class="text-2xl font-bold">{{ $user->name ?? 'Utilisateur' }}</h1>
                            @if($user && $user->title)
                                <p class="text-gray-600">{{ $user->title }}</p>
                            @endif
                            
                            @if($user && $user->bio)
                                <div class="mt-4">
                                    <h3 class="text-lg font-semibold">À propos</h3>
                                    <p class="mt-2 text-gray-600">{{ $user->bio }}</p>
                                </div>
                            @endif

                            @if($user && $user->skills)
                                <div class="mt-4">
                                    <h3 class="text-lg font-semibold">Compétences</h3>
                                    <div class="mt-2 flex flex-wrap gap-2">
                                        @foreach(explode(',', $user->skills) as $skill)
                                            <span class="px-3 py-1 bg-gray-100 rounded-full text-sm">{{ trim($skill) }}</span>
                                        @endforeach
                                    </div>
                                </div>
                            @endif

                            @if($user && $user->experience)
                                <div class="mt-4">
                                    <h3 class="text-lg font-semibold">Expérience</h3>
                                    <p class="mt-2 text-gray-600">{{ $user->experience }} années d'expérience</p>
                                </div>
                            @endif

                            <div class="mt-6 flex space-x-4">
                                @if($user && $user->linkedin)
                                    <a href="{{ $user->linkedin }}" target="_blank" class="text-blue-600 hover:text-blue-800">
                                        <i class="fab fa-linkedin text-xl"></i>
                                        <span class="ml-1">LinkedIn</span>
                                    </a>
                                @endif

                                @if($user && $user->github)
                                    <a href="{{ $user->github }}" target="_blank" class="text-gray-600 hover:text-gray-800">
                                        <i class="fab fa-github text-xl"></i>
                                        <span class="ml-1">GitHub</span>
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
