<x-form-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Update Task') }}: {{$task->name}}
        </h2>
    </x-slot>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('tasks.update', $task) }}">
        @csrf

        <input type="hidden" name="_method" value="PUT">

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Name')" />
            <x-text-input id="email" class="block mt-1 w-full" type="text" name="name" :value="$task->name" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="project" :value="__('Project')" />

            <select id="project" class="block mt-1 w-full" name="project_id" required>
                <option value="" disabled selected>Select a project</option>
                @foreach($projects as $project)
                <option value="{{ $project->id }}" @selected($task->project_id == $project->id)>{{ $project->name }}</option>
                @endforeach
            </select>

            <x-input-error :messages="$errors->get('project_id')" class="mt-2" />
        </div>

         <!-- Priority Position -->
         <div class="mt-4">
            <x-input-label :value="__('Priority Position')" />

            <div class="mt-2">
                <label for="priority_top" class="inline-flex items-center">
                    <input id="priority_top" type="radio" class="form-radio" name="priority_position" value="top" >
                    <span class="ml-2 text-sm">{{ __('Top') }}</span>
                </label>

                <label for="priority_bottom" class="inline-flex items-center ml-6">
                    <input id="priority_bottom" type="radio" class="form-radio" name="priority_position" value="bottom">
                    <span class="ml-2 text-sm">{{ __('Bottom') }}</span>
                </label>
            </div>

            <x-input-error :messages="$errors->get('priority_position')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="ml-3">
                {{ __('Update') }}
            </x-primary-button>
        </div>
    </form>
</x-form-layout>
