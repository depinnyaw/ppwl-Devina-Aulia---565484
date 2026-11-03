
@extends('layouts.app')

@section('title', 'Profil Saya')

@section('content')
    <div class="max-w-7xl mx-auto py-10 px-4 sm:px-6 lg:px-8">
        <div class="bg-white shadow-sm rounded-lg p-6">
            <h1 class="text-2xl font-semibold text-gray-800 mb-6">
                Profil Saya
            </h1>

            <div class="space-y-4">
                <div>
                    <p class="text-sm text-gray-500">Nama</p>
                    <p class="font-medium text-gray-900">{{ $user->name }}</p>
                </div>

                <div>
                    <p class="text-sm text-gray-500">Email</p>
                    <p class="font-medium text-gray-900">{{ $user->email }}</p>
                </div>
            </div>
        </div>
    </div>
@endsection
