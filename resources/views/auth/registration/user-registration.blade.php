<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Registration</title>
    <link rel="icon" type="image/png" href="{{ asset('img/logo.png') }}">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/auth/registration/user-registration.css') }}">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Custom JS -->
    <script src="{{ asset('js/auth/registration/user-registration.js') }}" defer></script>
</head>
<body>

    <header>
        @include('layouts.header')
    </header>

    <section id="main-content">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-10 col-sm-6 col-md-6 col-lg-6 col-xl-4">
                    <div class="bg-white ps-4 pe-4 pt-3 pb-3 rounded shadow">
                        <h3 class="text-center mb-2">Join Us!</h3>
                        <div id="formMessage" class="alert d-none" role="alert"></div>
                        <form>
                            @csrf
                            {{-- Name --}}
                            <div class="mb-2">
                                <p class="content-text">Name</p>
                                <div class="position-relative input-wrapper">
                                    <input type="text" class="form-control validated-input" placeholder="Name" id="nameInput" name="fname">
                                    <span class="validation-icon" id="nameIcon"></span>
                                </div>
                                <div class="invalid-feedback d-block ms-2" id="nameError"></div>
                            </div>

                            {{-- Surname --}}
                            <div class="mb-2">
                                <p class="content-text">Surname</p>
                                <div class="position-relative input-wrapper">
                                    <input type="text" class="form-control validated-input" placeholder="Surname" id="surnameInput" name="lname">
                                    <span class="validation-icon valid" id="surnameIcon"></span>
                                </div>
                                <div class="invalid-feedback d-block ms-2" id="surnameError"></div>
                            </div>

                            {{-- Email --}}
                            <div class="mb-2">
                                <p class="content-text">Email</p>
                                <div class="position-relative input-wrapper">
                                    <input type="email" class="form-control validated-input" placeholder="Email" id="emailInput" name="email">
                                    <span class="validation-icon" id="emailIcon"></span>
                                </div>
                                <div class="invalid-feedback d-block ms-2" id="emailError"></div>
                            </div>

                            {{-- Password --}}
                            <div class="mb-2">
                                <p class="content-text">Password</p>
                                <div class="position-relative input-wrapper">
                                    <input type="password" class="form-control validated-password-input" placeholder="Password" id="passwordInput" name="password">
                                    <span class="toggle-password" id="togglePassword">
                                        <i class="fas fa-eye"></i>
                                    </span>
                                    <span class="validation-password-icon" id="passwordIcon"></span>
                                </div>
                                <div class="invalid-feedback d-block ms-2" id="passwordError"></div>
                            </div>

                            {{-- Repeat Password --}}
                            <div class="mb-2">
                                <p class="content-text">Repeat password</p>
                                <div class="position-relative input-wrapper">
                                    <input type="password" class="form-control validated-password-input" placeholder="Password" id="repeatPasswordInput" name="password">
                                    <span class="toggle-password" id="toggleRepeatPassword">
                                        <i class="fas fa-eye"></i>
                                    </span>
                                    <span class="validation-password-icon" id="repeatPasswordIcon"></span>
                                </div>
                                <div class="invalid-feedback d-block ms-2" id="repeatPasswordError"></div>
                            </div>

                            {{-- Agreement --}}
                            <div class="form-check mb-3">
                                <input class="form-check-input" type="checkbox" id="agree">
                                <label class="form-check-label" for="agree">
                                    I agree to the <a href="#" data-bs-toggle="modal" data-bs-target="#termsModal">terms & conditions</a>
                                </label>
                            </div>

                            {{-- Modal --}}
                            <div class="modal fade" id="termsModal" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-scrollable">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Terms & Conditions</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <h6>Welcome to InfoGo!</h6>
                                            <p>By registering on this website, you agree to our general terms of service and privacy policy...</p>
                                            <ul>
                                                <li>We do not sell your data.</li>
                                                <li>We expect respectful behavior.</li>
                                                <li>You are responsible for your account.</li>
                                            </ul>
                                            <p class="text-muted"><small>Last updated: March 2025</small></p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <button type="button" id="submitBtn" class="btn btn-dark w-100">Submit</button>
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
