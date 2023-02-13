<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Todo List</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- Tempusdominus Bbootstrap 4 -->
    <link rel="stylesheet" href="{{ url('/') }}/backend/adminlte3/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    
    <!-- DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.2/css/jquery.dataTables.min.css">
    <!-- <link rel="stylesheet" href="{{ url('/') }}/backend/adminlte3/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ url('/') }}/backend/adminlte3/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ url('/') }}/backend/adminlte3/plugins/datatables-buttons/css/buttons.bootstrap4.min.css"> -->
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"> -->
    <input type="hidden" class="token" value="{!! csrf_token() !!}">
    <script src="https://cdn.ckeditor.com/4.12.1/full/ckeditor.js"></script> 
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">Todo List</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>

<!-- jQuery -->
<script src="{{ url('/') }}/backend/adminlte3/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ url('/') }}/backend/adminlte3/plugins/jquery-ui/jquery-ui.min.js"></script>


<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{ url('/') }}/backend/adminlte3/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- InputMask -->
<script src="{{ url('/') }}/backend/adminlte3/plugins/moment/moment.min.js"></script>
<!-- <script src="{{ url('/') }}/backend/adminlte3/plugins/inputmask/min/jquery.inputmask.bundle.min.js"></script> -->
<!-- Select2 -->
<script src="{{ url('/') }}/backend/adminlte3/plugins/select2/js/select2.full.min.js"></script>
<!-- bs-custom-file-input -->
<script src="{{ url('/') }}/backend/adminlte3/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script>
<!-- <script src="{{ url('/') }}/backend/adminlte3/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="{{ url('/') }}/backend/adminlte3/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="{{ url('/') }}/backend/adminlte3/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="{{ url('/') }}/backend/adminlte3/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="{{ url('/') }}/backend/adminlte3/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="{{ url('/') }}/backend/adminlte3/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="{{ url('/') }}/backend/adminlte3/plugins/jszip/jszip.min.js"></script>
<script src="{{ url('/') }}/backend/adminlte3/plugins/pdfmake/pdfmake.min.js"></script>
<script src="{{ url('/') }}/backend/adminlte3/plugins/pdfmake/vfs_fonts.js"></script>
<script src="{{ url('/') }}/backend/adminlte3/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="{{ url('/') }}/backend/adminlte3/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="{{ url('/') }}/backend/adminlte3/plugins/datatables-buttons/js/buttons.colVis.min.js"></script> -->

<script>
    $(function () {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        })
        CKEDITOR.replace('editor2');
        // CKEDITOR.replace('upd_description', {
        //     filebrowserUploadUrl: "{{route('ckeditor.upload', ['_token' => csrf_token() ])}}",
        //     filebrowserUploadMethod: 'form'
        // });
    })
    /** Read more */
    // Hide the extra content initially, using JS so that if JS is disabled, no problemo:
    $('.read-more-content').addClass('hide_content')
    $('.read-more-show, .read-more-hide').removeClass('hide_content')

    // Set up the toggle effect:
    $('.read-more-show').on('click', function(e) {
        $(this).next('.read-more-content').removeClass('hide_content');
        $(this).addClass('hide_content');
        e.preventDefault();
    });

    // Changes contributed by @diego-rzg
    $('.read-more-hide').on('click', function(e) {
        var p = $(this).parent('.read-more-content');
        p.addClass('hide_content');
        p.prev('.read-more-show').removeClass('hide_content'); // Hide only the preceding "Read More"
        e.preventDefault();
    });


    $(document).on('click' , '.viewTask',function () {  
        var title = $(this).parent('div').siblings('.title').val();  
        var description = $(this).parent('div').siblings('.description').val();  
        $(".title").html(title);  
        $(".description").html(description);  
    });  
    $(document).on('click' , '.editTask',function () {  
        var todolist_id = $(this).parent('div').siblings('.todolist_id').val();  
        var title = $(this).parent('div').siblings('.title').val();  
        var description = $(this).parent('div').siblings('.description').val();  
        console.log(description)
        $(".upd_id").val(todolist_id);  
        $(".upd_title").val(title);  
        $(".upd_description").text(description);  
        CKEDITOR.replace('editor3');
    });  
    
    
</script>
</html>
