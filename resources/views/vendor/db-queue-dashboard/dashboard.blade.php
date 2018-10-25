<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <title>{{config('app.name')}}</title>
    <link href=" {{ asset('vendor/db-queue-dashboard/css/app.css') }}" rel="stylesheet">

    <script>
        window.pusher_key = "{{env('MIX_PUSHER_APP_KEY')}}";
    </script>
</head>
<body>
    <div id="app">
        <database-queue-dashboard></database-queue-dashboard>
    </div>

    <script src="{{ asset('vendor/db-queue-dashboard/js/app.js') }}"></script>
</body>
</html>