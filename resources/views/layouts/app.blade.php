<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name') }} | @yield('title')</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        @livewireStyles
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">

        <link rel="stylesheet" href="{{ asset('front/css/bootstrap.css') }}">
        <link href="{{ asset('front/plugins/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
        <link href="{{ asset('front/plugins/datatables/media/css/dataTables.bootstrap.css') }}" rel="stylesheet">
        <link href="{{ asset('front/plugins/datatables/extensions/Responsive/css/dataTables.responsive.css') }}" rel="stylesheet">
        {{-- <link rel="stylesheet" href="{{ asset('front/css/sweetalert.min.css')}}"> --}}
        <link href="{{ asset('front/plugins/fooTable/css/footable.core.css') }}" rel="stylesheet">
        {{-- <link href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.dataTables.min.css" rel="stylesheet"> --}}
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" rel="stylesheet">
        <link href=" https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap5.min.css" rel="stylesheet">

        <!-- Scripts -->
        <script src="{{ mix('js/app.js') }}" defer></script>
    </head>
    <body class="font-sans antialiased">

        <div class="flex flex-col h-screen justify-between bg-gray-100">
            @livewire('navigation-dropdown')

            <!-- Page Heading -->
            <header class="h-full border-b bg-white shadow">
                <div class="flex justify-between max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{-- {{ $header }} --}}
                    @yield('header')
                </div>
            </header>

            <!-- Page Content -->
            <main class="md:auto">
                <div class="py-12">
                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                            {{ $slot }}
                        </div>
                    </div>
                </div>
            </main>

            {{-- @stack('modals') --}}




            <footer class="h-full bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <p class="text-center font-semibold text-sm text-gray-600">Develop By <a class="text-sm text-indigo-700" href="http://www.aisent.net/" target="_blank">Aisent</a> 2021 All Right Reserved &#0169;</p>
                </div>
            </footer>
        </div>

        @livewireScripts
        <!--JAVASCRIPT-->
        <!--=================================================-->
        <!--jQuery [ REQUIRED ]-->
        <script src="{{ asset('front/js/jquery-2.1.1.min.js') }}"></script>
        <script src="{{ asset('front/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('front/js/scripts.js') }}"></script>
        <script src="{{ asset('front/plugins/moment/moment.min.js') }}"></script>
        <script src="{{ asset('front/plugins/moment-range/moment-range.js') }}"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.bootstrap4.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.flash.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.print.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
        <script src="{{ asset('front/plugins/screenfull/screenfull.js') }}"></script>
        <script src="{{ asset('front/plugins/fooTable/dist/footable.all.min.js') }}"></script>
        <script src="{{ asset('front/plugins/jquery-print/jQuery.print.js') }}"></script>
        <script src="{{ asset('front/plugins/datatables/media/js/jquery.dataTables.js') }}"></script>
        <script src="{{ asset('front/plugins/datatables/media/js/dataTables.bootstrap.js') }}"></script>
        <script src="{{ asset('front/plugins/datatables/extensions/Responsive/js/dataTables.responsive.min.js') }}"></script>
        <script src="{{ asset('vendor/sweetalert/sweetalert.all.js') }}"></script><script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.9/sweetalert2.min.js"></script>
        {{-- @include('sweetalert::alert') --}}
        @yield('scripts')
        <script>
            function received(url,el) {
                swal({
                    title: "{{ __('Are you sure') }}?",
                    text: "{{ __('انه تم دفع قيمه هده الفاتوره') }} ",
                    // icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: '#DD6B55',
                    confirmButtonText: '{{ __('Yes, I am sure!') }}',
                    cancelButtonText: "{{ __('No, cancel it') }}"
                }).then(
                    function (obj) {
                        // if (obj.value) {
                        window.location = url;
                    }
                );
            }
            function editDate(date,href,event) {
                let modal = $('#editDateModal');
                modal.find('.modal-body input[name="date"]').val(date);

                modal.find('.modal-body form').attr("action", href);

            };
        </script>
    </body>
</html>
