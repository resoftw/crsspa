<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>CRS</title>

        <!-- Fonts Nunito -->
        <link href='https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons' rel="stylesheet"> 

        <link href="{{asset('css/app.css')}}" rel="stylesheet" type='text/css'>
    </head>
    <body>
        <div id='app'>
            <component :is="_layout">
                <router-view></router-view>
            </component>
        </div>
        <script src="{{asset('js/app.js')}}"></script>
    </body>
</html>
