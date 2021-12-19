<div class="container-fluid">
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
                    background-color: black;
                    color: white;
                    text-decoration: none;
                    font-size: 15px;
                    display: inline-block;
                    padding: 0px 10px;
                    margin-right:10px;
                    border-radius: 8px;
                    transition: 250ms;
                }

                .user_reg a:hover{
                    background-color: rgb(255, 153, 0);
                    color: black;
                    transition: 250ms;
                }


                .logo{
                    font-family: 'Playfair Display', serif;
                    position: relative;
                    top: -10px;
                    border-radius: 10px;
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
                    <h1><a href="#" style="text-decoration: none; color:black">Old Towner</a></h1>
                </div>
                <div class="nav-menu">
                        <a href="#">Newsfeed </a>
                        <a href="#">Categories </a>
                        <a href="#">Search </a>
                </div>
            </div>
        </div>
    @endif
</div>