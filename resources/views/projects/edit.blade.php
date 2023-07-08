<x-form-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Update project') }}: {{$project->name}}
        </h2>
    </x-slot>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('projects.update', $project) }}">
        @csrf

        <input type="hidden" name="_method" value="PUT">

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Name')" />
            <x-text-input id="email" class="block mt-1 w-full" type="text" name="name" :value="$project->name" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="ml-3">
                {{ __('Update') }}
            </x-primary-button>
        </div>
    </form>
</x-form-layout>
