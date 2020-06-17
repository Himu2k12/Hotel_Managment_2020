@include('Backend.includes.header')
<!-- Page Wrapper -->
<body id="page-top">

<!-- Page Wrapper -->
<div id="wrapper">

@include('Backend.includes.sidebar')

<!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            @include('Backend.includes.navbar')

        @yield('content')
        </div>

    </div>
    <!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->


</div>


@include('Backend.includes.footer')
@include('Backend.includes.footer-script')


</body>
</html>
