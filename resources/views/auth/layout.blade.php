<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="author" content="Mohammad Hafijul Islam">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style>
        html, body {
            height: 100%;
        }

        .login-page {
            background-color: #f7f9fb;
            font-size: 14px;
        }

        .login-page .brand {
            width: 90px;
            height: 90px;
            overflow: hidden;
            border-radius: 50%;
            margin: 40px auto;
            box-shadow: 0 4px 8px rgba(0, 0, 0, .05);
            position: relative;
            z-index: 1;
        }

        .login-page .brand img {
            width: 100%;
        }

        .login-page .card-wrapper {
            width: 400px;
        }

        .login-page .card {
            border-color: transparent;
            box-shadow: 0 4px 8px rgba(0, 0, 0, .05);
        }

        .login-page .card.fat {
            padding: 10px;
        }

        .login-page .card .card-title {
            margin-bottom: 30px;
        }

        .login-page .form-control {
            border-width: 2.3px;
        }

        .login-page .form-group label {
            width: 100%;
        }

        .login-page .btn.btn-block {
            padding: 12px 10px;
        }

        .login-page .footer {
            margin: 40px 0;
            color: #888;
            text-align: center;
        }

        @media screen and (max-width: 425px) {
            .login-page .card-wrapper {
                width: 90%;
                margin: 0 auto;
            }
        }

        @media screen and (max-width: 320px) {
            .login-page .card.fat {
                padding: 0;
            }

            .login-page .card.fat .card-body {
                padding: 15px;
            }
        }
    </style>
</head>

<body class="login-page">
<section class="h-100">
    <div class="container h-100">
        <div class="row justify-content-md-center h-100">
            <div class="card-wrapper">
                <div class="brand">
                    <img
                        src="data:image/jpeg;base64,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"
                        alt="logo">
                </div>
                <div class="card fat">
                    <h4 class="card-title">@yield('title')</h4>
                    @yield('content')
                    {{--<div class="card-body">
                        <div class="form-group">
                            <label for="email">E-Mail Address</label>
                            <input id="email" type="email" class="form-control" name="email" value="" required
                                   autofocus>
                            <div class="invalid-feedback">
                                Email is invalid
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password">Password
                                <a href="forgot.html" class="float-right">
                                    Forgot Password?
                                </a>
                            </label>
                            <input id="password" type="password" class="form-control" name="password" required data-eye>
                            <div class="invalid-feedback">
                                Password is required
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="custom-checkbox custom-control">
                                <input type="checkbox" name="remember" id="remember" class="custom-control-input">
                                <label for="remember" class="custom-control-label">Remember Me</label>
                            </div>
                        </div>

                        <div class="form-group m-0">
                            <button type="submit" class="btn btn-primary btn-block">
                                Login
                            </button>
                        </div>
                        <div class="mt-4 text-center">
                            Don't have an account? <a href="register.html">Create One</a>
                        </div>
                        </form>
                    </div>--}}
                </div>
                <div class="footer">
                    Copyright &copy; {{ date('Y') }} &mdash; All rights reserved.
                </div>
            </div>
        </div>
    </div>
</section>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"
        integrity="sha512-rstIgDs0xPgmG6RX1Aba4KV5cWJbAMcvRCVmglpam9SoHZiUCyQVDdH2LPlxoHtrv17XWblE/V/PP+Tr04hbtA=="
        crossorigin="anonymous"></script>
@stack('page-script')
</body>
</html>
