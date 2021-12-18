    @if (Route::has('login'))
        <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
            <style>
                @import url('https://fonts.googleapis.com/css2?family=Playfair+Display&display=swap');

                .nav-menu a{
                    color: black;
                    text-decoration: none;
                    margin-left: 10px;
                }

                .user_reg a{
                    color: white;
                    text-decoration: none;
                    font-size: 15px;
                    display: inline-block;
                    padding: 0px 10px;
                    margin-right:10px;
                }

                .user_reg a:link{
                    background-color: black;
                    border-radius: 8px;
                }

                .logo{
                    font-family: 'Playfair Display', serif;
                    position: relative;
                    top: -10px;
                }

            </style>

            
            <div class="d-flex justify-content-between">
                <div class='user_reg'>
                    @auth
                        <a href="{{ url('/home') }}" >Home</a>
                    @else
                        <a href="{{ route('login') }}">Log in</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
                <div class="logo">
                    <h1>Old Towner</h1>
                </div>
                <div class="nav-menu">
                        <a href="#">Newsfeed </a>
                        <a href="#">Categories </a>
                        <a href="#">Search </a>
                </div>
            </div>
            @include('myline')
        </div>
    @endif
