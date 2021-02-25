<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">


    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script>
        <?php
        if (isset($_COOKIE['scroll_val'])) {

            echo 'var scroll_val=' . '"' . (int) $_COOKIE['scroll_val'] . '";';

            setcookie('scroll_val', '', -3000);
        }

        if (isset($_COOKIE['accordion_val'])) {
            echo 'var accordion_val=' . '"' .  $_COOKIE['accordion_val'] . '";';
            setcookie('accordion_val', '', -3000);
            }
        ?>


    </script>
</head>

<body>
    <div id="app">
        @include('backend.partials.navigation.main')

        <div class="row">
            <div class="col-md-12">
                @if ($errors->any())
                <br>
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
            </div>
        </div>

        <div class="container mt-4">
            <div class="row">
                <div class="col-md-2">
                    @include('backend.partials.navigation.second', ['boards' => auth()->user()->boards()->get()])
                </div>
                <div class="col-md-10 min-vh-100">
                    @yield('content')
                </div>
            </div>
        </div>

        @include('partials.footer')
    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous">
    </script>
    @stack('scripts')


    <script>
        $(function () {


if (typeof scroll_val !== 'undefined') {

    $(window).scrollTop(scroll_val);
}

if(accordion_val) {
    const accordion = document.getElementById(`collapse${accordion_val}`);
    console.log(accordion);

    accordion.classList.add('show');
     
}




});


function scroll_value(e)
{
    document.cookie = 'scroll_val' + '=' + $(window).scrollTop();
    
 }


$(document).on('click', '.keep_position', function (e) {
    document.cookie = 'accordion_val' + '=' + e.target.getAttribute("data-accord");
    scroll_value();
});



    </script>
</body>

</html>