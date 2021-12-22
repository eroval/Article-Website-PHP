        @section('mystyles')
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- Styles -->
        <link rel="stylesheet" href="{{asset('css/app.css')}}">
        <style>
            @import url('https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@600&display=swap');
            .my_line{
                padding: 0.5px;
                background: rgb(0,0,0);
                background: linear-gradient(90deg, rgba(0,0,0,0) 0%, rgba(0,0,0,0.8) 50%, rgba(0,0,0,0) 100%);
            }
            
            .my_line_begin{
                padding: 0.5px;
                background: rgb(0,0,0); 
                background: linear-gradient(90deg, rgba(0,0,0,1) 0%, rgba(0,0,0,0) 100%);
            }

            .my_line_begin_short{
                padding: 0.5px;
                background: rgb(0,0,0); 
                background: linear-gradient(90deg, rgba(0,0,0,1) 0%, rgba(0,0,0,0) 30%);
            }

            .verical_line{
                height:200px;
                width:200px;
                padding: 0.5px;
                background: rgb(0,0,0);
                background: linear-gradient(0deg, rgba(0,0,0,0) 0%, rgba(0,0,0,0.8) 50%, rgba(0,0,0,0) 100%);
            }

            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>
        @endsection
        

        @section('header')
        <div class="content" >
            <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
                @include('headnav')
                @include('myline')
            </div>
        </div>
        @endsection


        @section('mycontent')
            <div class="my_content" style="display: flex; min-height:1000px; min-width:600px; width: 100%; height: 80%; font-family: 'Cormorant Garamond'; ">
                <div class="container-fluid" style='margin-top: 20px;'>
                    <div class="card-body">
                        @section('hbtn')
                            @if (Auth::check())
                            <!-- <div class="d-flex flex-row-reverse"> -->
                                <div class="d-flex flex-column">
                                    <div class="hand-button">
                                        <a href="{{ url('/create-article') }}">Create</a>
                                    </div>
                                </div>
                            <!-- </div> -->
                            @endif
                        @endsection
                        @section('vertical-line')
                            @if (Auth::check())
                                @include('mylinevertical')
                            @endif
                        @endsection
                        <div class="d-flex justify-content-between">
                            @if ($articles?? '')
                                <div class="d-flex flex-fill flex-column">
                                    @foreach($articles as $element)
                                        <div class="card" style="margin-top: 10px; margin-right:50px;border: 1px solid rgba(0,0,0,45);">
                                            <h5 class="card-header">{{$element['headline']}}</h5>
                                            <div class="card-body">
                                                <div class="card-title">Created by: {{$element['user']}}</div>
                                                <div class="card-subtitle mb-2 text-muted">{{$element['created_at']}}</div>
                                                <div class="d-flex flex-row">
                                                    <div class="my_link">
                                                        <a href="{{url('/article/' . $element->id )}}" class="card-link">View</a>
                                                    </div>   
                                                    @if (Auth::user() && Auth::user()->id == $element->author_id)
                                                    <div class="my_link">
                                                        <a href="{{url('/edit-article/' . $element->id )}}" class="card-link">Edit</a>
                                                    </div>
                                                    <div class="my_link">
                                                        <a href="{{url('/delete-article/' . $element->id )}}" class="card-link">Delete</a>
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div> 
                            @endif
                            @yield('vertical-line')
                            @yield('hbtn')
                        </div>
                        
                        @if ($articles?? '')
                            <div class="d-flex justify-content-center" style="margin-top: 30px;">
                                {{ $articles->links('pagination::bootstrap-4') }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        @endsection
        

        @section('article-creator')
            <div class="my_content" style="min-height: 1000px; display: flex; min-width:600px; width: 100%; height: 80%; font-family: 'Cormorant Garamond'; ">
                <div class="container-fluid">  
                    <div class="card-body">
                        {{-- <form name="create-article" id='create-article' method="POST" action="{{ url(@csrf) }}"> --}}
                        <form name="create-article" id='create-article' method="POST" action="{{ url('store-article') }}">
                            @csrf
                            <div class="form-group">
                                <label for="exampleHeadline">Headline</label>
                                <input type="text" id="headline" name="headline" class="form-control" required="">
                            </div>
                            <div class="form-group">
                                <label for="exampleTags">Tags</label>
                                <input type="text" id="tags" name="tags" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="exampleContent">Content</label>
                                <textarea name="content" style="height: 750px; overflow-y: auto; resize:none;" class="form-control" required=""></textarea>
                            </div>  
                            <div style="display: flex; justify-content: center;">
                            <button type="submit" class="btn btn-primary" style="margin-top: 10px;">Submit</button>
                            </div>                     
                        </form>
                    </div>
                </div>
            </div>
        @endsection
        

        @section('article-creator-error')
            <div class="my_content" style="min-height: 1000px; min-width:600px; display: flex; width: 100%; height: 80%; font-family: 'Cormorant Garamond'; ">
                <div class="container-fluid" style="display:flex; justify-content: center;" > 
                    <div class="d-flex align-self-center">
                        <h1>Cannot create article without signing in.</h1>
                    </div> 
                </div>
            </div>
        @endsection


        @if ($article?? '')
        @section('article-page')
        <div class="my_content" style="display: flex; min-height:1000px; min-width:600px; width: 100%; height: 80%; font-family: 'Cormorant Garamond'; ">
            <div class="container-fluid">
                <div class="card-body">
                    <h2 class="card-title">{{$article['headline']}}</h2>
                    @include('mylinebegin')
                    <br>
                    <div>
                        <textarea readonly name="content" style="background-color: #fcfcfc; height: 750px; overflow-y: auto; resize:none;  width:100%; border:none; outline:none; " >{{$article['content']}}</textarea>
                    </div>
                    @include('mylinebegin')
                    <br>
                    <p>Created by: {{$article['user']}}</p>
                    @include('mylinebeginshort')
                    <p>Date: {{$article['created_at']}}</p>
                    @include('mylinebeginshort')

                </div>
            </div>
        </div>
        @endsection
        @endif

        
        @if ($article?? '')
        @section('article-editor')
            <div class="my_content" style="min-height: 1000px; display: flex; min-width:600px; width: 100%; height: 80%; font-family: 'Cormorant Garamond'; ">
                <div class="container-fluid">  
                    <div class="card-body">
                        <?php $myurl="/update-article/" . $article->id . ""; 
                              //echo $myurl;
                        ?>
                        {{-- <form name="edit-article" id='edit-article' method="POST" action="{{ url(@csrf) }}"> --}}
                        <form name="edit-article" method="POST" action="{{ url($myurl) }}">
                            @method('PATCH')
                            @csrf
                            <div class="form-group">
                                <label for="exampleHeadline">Headline</label>
                                <input type="text" id="headline" name="headline" class="form-control" value="{{$article['headline']}}">
                            </div>
                            <div class="form-group">
                                <label for="exampleTags">Tags</label>
                                <input type="text" id="tags" name="tags" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="exampleContent">Content</label>
                                <textarea name="content" style="height: 750px; overflow-y: auto; resize:none;" class="form-control" >{{$article['content']}}</textarea>
                            </div>  
                            <div style="display: flex; justify-content: center; ">
                            <a href="{{url('/')}}" class="btn btn-secondary" style="margin-top: 10px; margin-right:10px;">Cancel</a>
                            <button type="submit" class="btn btn-primary" style="margin-top: 10px; margin-left:10px;">Update</button>
                            </div>                     
                        </form>
                    </div>
                </div>
            </div>
        @endsection
        @endif


        @section('myfooter')
        <p style="margin-top: 15px; text-align:center; padding-bottom:15px;">Copyright: The Amazing (Just) Man</p>
        @endsection


        @section('scripts')
        <script src="{{ asset('js/app.js') }}"></script>
        @endsection