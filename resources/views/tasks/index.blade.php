<x-app-layout>



    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Task List') }}
        </h2>
        (Use drag and drop to update priority, inorder to put a task on the higherst or top priority edit the task)
        @if (session('success'))
        <div class="font-medium text-sm text-green-600">
            {{ session('success') }}
        </div>
    @endif
    </x-slot>

    <x-primary-button class="ml-3">
        <a href="{{route('tasks.create')}}">{{ __('Add Task') }}</a>
    </x-primary-button>

<br><br>
    <form method="GET" action="{{ route('tasks.index') }}" class="ml-3">
        <div class="flex">
            <label for="project_id" class="mr-2">{{ __('Filter by Project') }}</label>
            <br>
            <select name="project_id" id="project_id" class="form-select rounded-md shadow-sm" onchange="this.form.submit()">
                <option value="">{{ __('All Projects') }}</option>
                @foreach($projects as $project)
                    <option value="{{ $project->id }}" @if(request('project_id') == $project->id) selected @endif>{{ $project->name }}</option>
                @endforeach
            </select>


        </div>
    </form>

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
                                Priority
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Project
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200 sortable">
                        @foreach ($tasks as $task)
                            <tr data-id="{{$task->id}}" class="hover:bg-gray-100">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ $task->id }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ $task->name }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ $task->priority }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ $task->project->name }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <x-primary-button class="ml-3">
                                        <a href="{{route('tasks.edit', $task)}}">{{ __('Edit Task') }}</a>
                                    </x-primary-button>

                                </td>
                                <td  class="px-6 py-4 whitespace-nowrap">
                                    <form method="POST" action="{{ route('tasks.destroy', $task) }}" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900">{{ __('Delete Task') }}</button>
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
