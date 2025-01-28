@include('shared_pages.header')

<body>
    <div id="app">
        {{-- menu sidebar --}}
        @include('shared_pages.sidebar')
        <div id="main" class='layout-navbar'>
            <header class='mb-3'>
                {{-- menu sidebar --}}
                @include('shared_pages.navbar')

            </header>
            <div id="main-content">

                <div class="page-heading">
                    {{-- heading halaman --}}
                    @include('shared_pages.heading')

                    <!-- awal halaman content -->
                    @yield('content')
                    <!-- akhir halaman content -->
                </div>

                {{-- footer --}}
                @include('shared_pages.footer')
            </div>
        </div>
    </div>
    <script src="/assets/js/bootstrap.js"></script>
    <script src="/assets/js/app.js"></script>

    <script src="https://cdn.datatables.net/v/bs5/dt-1.12.1/datatables.min.js"></script>
    <script src="/assets/js/pages/datatables.js"></script>

    <script src="/assets/static/js/components/dark.js"></script>
    <script src="/assets/extensions/perfect-scrollbar/perfect-scrollbar.min.js"></script>

    <script src="/assets/compiled/js/app.js"></script>

    <!-- Need: Apexcharts -->
    <script src="/assets/extensions/apexcharts/apexcharts.min.js"></script>

</body>

</html>
