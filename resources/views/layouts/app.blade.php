<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.0/jquery-ui.min.js"></script>


    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        @include('layouts.navigation')

        <!-- Page Heading -->
        @if (isset($header))
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endif

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
    </div>
</body>
<script>
    $(document).ready(function() {
    $('.sortable').sortable({
        axis: 'y',
        containment: 'parent',
        cursor: 'move',
        stop: function(event, row) {
            var movedTaskId = row.item.attr('data-id');
            var prevTaskId = row.item.prev('tr').attr('data-id');
            if(! prevTaskId)
            return;
            $.ajax({
                url: 'tasks/' + movedTaskId + '/update-priority',
                type: 'POST',
                data: {
                    prev_task_id: prevTaskId,
                    _token: "{{csrf_token()}}"
                },
                success: function(response) {
                    console.log(response);

                    // Update the task priorities in the table
                    $('.sortable tr').each(function(index) {
                        var priority = index + 1;
                        $(this).find('td:nth-child(3)').text(priority);
                    });
                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                }
            });
        }
    });
});
</script>

</html>
