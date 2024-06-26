<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="stylesheet" href="{{ asset('../assets/css/styles.min.css') }}" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">
        <div
            class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
            <div class="d-flex align-items-center justify-content-center w-100">
                <div class="row justify-content-center w-100">
                    <div class="col-md-8 col-lg-6 col-xxl-3">
                        <div class="card mb-0">
                            <div class="card-body">
                                <h2 class="text-center"><span class="fw-lighter">Employee</span>.<span
                                        class="text-secondary fw-bolder">App</span>
                                </h2>
                                <p class="text-center">Hard, smart and sincere work with Employee.App</p>
                                <form method="POST" action="{{ route('register') }}">
                                    @csrf

                                    <div class="mb-3">
                                        <label for="exampleInputtext1" class="form-label">Employee Name</label>
                                        <input type="text" class="form-control" id="exampleInputtext1"
                                            aria-describedby="textHelp" name="name">
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Email Address</label>
                                        <input type="email" class="form-control" id="exampleInputEmail1"
                                            aria-describedby="emailHelp" name="email">
                                    </div>
                                    <div class="mb-4">
                                        <label for="exampleInputPassword1" class="form-label">Password</label>
                                        <input type="password" class="form-control" id="exampleInputPassword1"
                                            name="password" required autocomplete="new-password">
                                    </div>
                                    <div class="mb-4">
                                        <label for="password-confirm"
                                            class="form-label">{{ __('Confirm Password') }}</label>
                                        <input type="password" class="form-control" id="password-confirm" required
                                            autocomplete="new-password" name="password_confirmation">
                                    </div>
                                    <button type="submit" class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2">Sign
                                        Up</button>
                                    <div class="d-flex align-items-center justify-content-center">
                                        <p class="fs-4 mb-0 fw-bold">Sudah punya akun?</p>
                                        <a class="text-primary fw-bold ms-2" href="{{ route('login') }}">Sign
                                            In</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </body>

</html>
