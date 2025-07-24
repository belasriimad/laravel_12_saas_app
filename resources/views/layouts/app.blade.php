<!doctype html>
<html lang="en" data-bs-theme="auto">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Laravel 12 SAAS APP - @yield('title')</title>
        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <!-- Main CSS -->
        <link href="{{asset('css/main.css')}}" rel="stylesheet">
        <!-- Fontawesome CSS -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <!-- Google Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Winky+Sans:ital,wght@0,300..900;1,300..900&display=swap" rel="stylesheet">
        <!-- Stripe  -->
        <script src="https://js.stripe.com/v3/"></script>
        <!-- Custom Styles -->
        @yield('styles')
    </head>
    <body class="bg-light">
        <div class="container">
            <div class="card my-5">
                <div class="card-body">
                    <div class="row">
                        <!-- content here -->
                        <div class="col-md-12">
                            @include('layouts.navbar')
                            @yield('content')
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Jquery JS -->
        <script
            src="https://code.jquery.com/jquery-3.7.1.min.js"
            integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo="
            crossorigin="anonymous"></script>
        <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        <!-- Sweet alert js -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <!-- Flash messages -->
        @session('success')
            <script>
                Swal.fire({
                    position: "top-end",
                    icon: "success",
                    title: "{{ session('success') }}",
                    showConfirmButton: false,
                    timer: 2500
                });
            </script>
        @endsession
        @session('error')
            <script>
                Swal.fire({
                    position: "top-end",
                    icon: "error",
                    title: "{{ session('error') }}",
                    showConfirmButton: false,
                    timer: 2500
                });
            </script>
        @endsession
        @session('info')
            <script>
                Swal.fire({
                    position: "top-end",
                    icon: "info",
                    title: "{{ session('info') }}",
                    showConfirmButton: false,
                    timer: 2500
                });
            </script>
        @endsession
        <script>
            //function to delete items: qrcodes, plans, users...
            function deleteItem(id) {
                Swal.fire({
                    title: "Are you sure?",
                    text: "You won't be able to revert this!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, delete it!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById(id).submit();
                    }
                });
            }
        </script>
        <!-- Custom JS -->
        @yield('scripts')
    </body>
</html>