<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <meta name="user" content="{{Auth::user()}}">

    <script src="https://unpkg.com/vue@latest"></script>
    <script src="https://unpkg.com/@vuepic/vue-datepicker@latest"></script>
    <link rel="stylesheet" href="https://unpkg.com/@vuepic/vue-datepicker@latest/dist/main.css">

    <script type="text/javascript">
        window.Laravel = {
            csrfToken: "{{ csrf_token() }}",
            jsPermissions: {!! auth()->user()
                ?->jsPermissions() !!}
        }
    </script>
    <script>
        const app = Vue.createApp({
            components: { Datepicker: VueDatePicker },
        }).mount("#app");
    </script>

    <script src="https://js.pusher.com/7.2/pusher.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    <title inertia>{{ config('Coorsa', 'Coorsa') }}</title>
    @routes
    @vite(['resources/js/app.js', "resources/js/Pages/{$page['component']}.vue"])
    @inertiaHead
</head>

<body class="bg-gray-100">
    @inertia
</body>
</html>
