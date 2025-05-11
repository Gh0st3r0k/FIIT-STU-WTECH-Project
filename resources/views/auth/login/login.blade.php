<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>LogIn</title>
    <link rel="icon" type="image/png" href="{{ asset('img/logo.png') }}">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom -->
    <link rel="stylesheet" href="{{ asset('css/auth/login/login.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <script src="{{ asset('js/auth/login/login.js') }}" defer></script>
</head>
<body>

    <header>
        @include('layouts.header')
    </header>

    <section id="main-content">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-10 col-sm-8 col-md-6 col-lg-6 col-xl-4">
                    <div class="bg-white ps-4 pe-4 pt-3 pb-3 rounded shadow">
                        <div id="formMessage" class="alert d-none" role="alert"></div>
                        <form>
                            @csrf
                            <div class="mb-2">
                                <p class="content-text">Email</p>
                                <div class="position-relative input-wrapper">
                                    <input type="email" class="form-control validated-input" placeholder="Email" id="emailInput" name="email">
                                    <span class="validation-icon" id="emailIcon"></span>
                                </div>
                                <div class="invalid-feedback d-block ms-2" id="emailError"></div>
                            </div>
                            <div class="mb-2">
                                <p class="content-text">Password</p>
                                <div class="position-relative input-wrapper">
                                    <input type="password" class="form-control validated-password-input" placeholder="Password" id="passwordInput" name="password">
                                    <span class="toggle-password" id="togglePassword"><i class="fas fa-eye"></i></span>
                                    <span class="validation-password-icon" id="passwordIcon"></span>
                                </div>
                                <div class="invalid-feedback d-block ms-2" id="passwordError"></div>
                            </div>
                            <button type="button" id="loginBtn" class="btn btn-dark w-100">Sign In</button>
                            <!-- <div class="mt-2">
                                <a href="#" class="link-secondary text-decoration-underline">Forgot password?</a>
                            </div> -->
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('layouts.footer')

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>