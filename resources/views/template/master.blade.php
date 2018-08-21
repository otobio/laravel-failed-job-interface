<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>{{config('app.name')}} | Failed Job Interface</title>

    <!-- Bootstrap core CSS -->
    <link href="{{route('fji.assets.css')}}" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"
          integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <style>
        body {
            padding-top: 5rem;
            /*background: #000000;*/
        }

        .tag-list {
            column-count: 5;
            padding: 0;
            margin: 0;
            list-style: none;
        }

        .tag-list li {
            margin-bottom: 10px;
        }

        .filter-btn,.refresh-btn  {
            padding: 0 20px;
        }

        .refresh-btn {
            margin-right: 20px;
            display: none;
        }
        .filter-body {
            display: none;
        }

        .open-filters .refresh-btn {
            display: block;
        }
        .open-filters .card-body {
            display: block;
        }

        .loader {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 100000;
            background: rgba(0,0,0,.3);
            display: none;
        }

        .loader.active {
            display: block;
        }

        .loader-container {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%,-50%);
        }

        [v-cloak] {display: none}

    </style>

    <script>
        window.FJI = {
            paths: {
                get_jobs: '{{route('fji.get-jobs')}}',
                get_job: '{{route('fji.get-job')}}',
                get_connections_filter: '{{route('fji.filters.connections')}}',
                get_tags_filter: '{{route('fji.filters.tags')}}',
                get_queues_filter: '{{route('fji.filters.queues')}}',
            }
        }
    </script>
</head>

<body class="{{config('failed_job_interface.display_filters') ? 'open-filters' : ''}}">

<div id="app">
    @include('fji::template.navigation')

    @yield('content')
</div>

<script src="{{route('fji.assets.js')}}"></script>
<script>
    $('.card').on('click', '.filter-btn', function () {
        $('body').toggleClass('open-filters');
    });
</script>

</body>
</html>
