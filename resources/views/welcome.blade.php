<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="{{asset('fontawesome-free-5.5.0-web/css/all.min.css')}}">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
            .glow {
                font-size: 80px;
                color: #fff;
                text-align: center;
                -webkit-animation: glow 3s ease-in-out infinite alternate;
                -moz-animation: glow 3s ease-in-out infinite alternate;
                animation: glow 3s ease-in-out infinite alternate;
            }

            @-webkit-keyframes glow {
                from {
                    text-shadow: 0 0 10px #3a3a3a, 0 0 20px #404202, 0 0 30px #264103, 0 0 40px #062f00, 0 0 50px #e60073, 0 0 60px #e60073, 0 0 70px #e60073;
                }
                to {
                    text-shadow: 0 0 20px #ff2837, 0 0 30px #4963ff, 0 0 40px #fffef0, 0 0 50px #7dff69, 0 0 60px #ff4da6, 0 0 70px #ff4da6, 0 0 80px #ff4da6;
                }
            }

        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            <div class="content">
                <div class="title m-b-md">
                    <h4 class="glow">ApiDoc</h4>
                </div>
                <div class="links">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/projects') }}"><i class="fa fa-list"></i> Projects</a>
                        @else
                            <a href="{{ route('login') }}"><i class="fa fa-sign-in-alt"></i> Login</a>

                            @if (Route::has('register'))
                                <a href="{{ route('register') }}"><i class="fa fa-user-plus"></i> Register</a>
                            @endif
                        @endauth
                    @endif
                </div>
            </div>
        </div>
    </body>
</html>
