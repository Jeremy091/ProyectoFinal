@php
    $layoutData['cssClasses'] =  'navbar navbar-vertical navbar-expand-lg';
@endphp
@section('body')
    <body>
    <div class="page">
        <!--* Sidebar *-->
        @include('tablar::partials.navbar.sidebar')
        @include('tablar::partials.header.sidebar-top')
        <div class="page-wrapper">
            <!--* Page Content *-->
            @hasSection('content')
                @yield('content')
            @endif
            <!--* Page Error *-->
            @include('tablar::error')
            @include('tablar::partials.footer.bottom')
        </div>
    </div>
    <script>
    (function() {
        let timeout;
        function resetTimeout() {
            clearTimeout(timeout);
            timeout = setTimeout(() => {
                window.location.reload(true);
            }, 600000); 
        }
        document.addEventListener('mousemove', resetTimeout);
        document.addEventListener('keydown', resetTimeout);
        resetTimeout(); // Inicializa el timeout al cargar la página
    })();
    </script>
    </body>
@stop
