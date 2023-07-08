<x-app-layout>



    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Project List') }}
        </h2>
        @if (session('success'))
        <div class="font-medium text-sm text-green-600">
            {{ session('success') }}
        </div>
    @endif
    @if (session('error'))
        <div class="font-medium text-sm text-red-600">
            {{ session('error') }}
        </div>
    @endif
    </x-slot>

    <x-primary-button class="ml-3">
        <a href="{{route('projects.create')}}">{{ __('Add project') }}</a>
    </x-primary-button>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                ID
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Name
                            </th>

                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Number of Tasks
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200 sortable">
                        @foreach ($projects as $project)
                            <tr data-id="{{$project->id}}" class="hover:bg-gray-100">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ $project->id }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ $project->name }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ $project->tasks_count }}
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap">
                                    <x-primary-button class="ml-3">
                                        <a href="{{route('projects.edit', $project)}}">{{ __('Edit project') }}</a>
                                    </x-primary-button>

                                </td>
                                <td  class="px-6 py-4 whitespace-nowrap">
                                    <form method="POST" action="{{ route('projects.destroy', $project) }}" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900">{{ __('Delete project') }}</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
