<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Jay's Beauty</title>
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('img/logo.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #18181c 0%, #2b2b36 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
            padding: 20px;
        }
        .login-card {
            width: 100%;
            max-width: 440px;
            background: #ffffff;
            border-radius: 16px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.3);
            overflow: hidden;
        }
        .login-header {
            background: #111114;
            padding: 35px 30px;
            text-align: center;
            border-bottom: 3px solid #c59d5f;
        }
        .login-header img {
            max-height: 50px;
            object-fit: contain;
        }
        .login-body {
            padding: 35px 30px;
        }
        .btn-gold {
            background: #c59d5f;
            color: #ffffff;
            font-weight: 600;
            padding: 12px;
            border: none;
            border-radius: 8px;
            transition: all 0.2s;
        }
        .btn-gold:hover {
            background: #b0894d;
            color: #ffffff;
        }
        .form-control {
            padding: 12px 14px;
            border-radius: 8px;
            border: 1px solid #ced4da;
        }
        .form-control:focus {
            border-color: #c59d5f;
            box-shadow: 0 0 0 0.25rem rgba(197, 157, 95, 0.25);
        }
        .input-group .btn-eye {
            border-color: #ced4da;
            color: #6c757d;
            background: #ffffff;
            transition: all 0.2s;
            padding: 0 14px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .input-group .btn-eye:hover {
            background-color: #f8f9fa;
            color: #c59d5f;
            border-color: #ced4da;
        }
        .input-group:focus-within .input-group-text,
        .input-group:focus-within .btn-eye {
            border-color: #c59d5f;
        }
    </style>
</head>
<body>

    <div class="login-card">
        <div class="login-header">
            <img src="{{ asset('img/logo.png') }}" alt="Jay's Beauty">
            <h5 class="text-white mt-3 mb-0 fw-normal" style="letter-spacing: 0.5px;">Admin Control Panel</h5>
        </div>
        <div class="login-body">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <small>{{ session('success') }}</small>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <small>{{ $errors->first() }}</small>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <form action="{{ route('admin.login.submit') }}" method="POST" autocomplete="off" id="adminLoginForm">
                @csrf

                <!-- Decoy inputs to block browser autofill -->
                <input type="text" name="fake_email_prevent" style="position: absolute; top: -9999px; left: -9999px; opacity: 0; width: 0; height: 0;" tabindex="-1" autocomplete="off">
                <input type="password" name="fake_password_prevent" style="position: absolute; top: -9999px; left: -9999px; opacity: 0; width: 0; height: 0;" tabindex="-1" autocomplete="off">

                <div class="mb-3">
                    <label class="form-label text-secondary fw-semibold small">Email Address</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light text-muted"><i class="fa-solid fa-envelope"></i></span>
                        <input type="email" name="email" id="adminEmail" class="form-control @error('email') is-invalid @enderror" value="" placeholder="Enter your email" autocomplete="new-password" required readonly onfocus="this.removeAttribute('readonly');">
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label text-secondary fw-semibold small">Password</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light text-muted"><i class="fa-solid fa-lock"></i></span>
                        <input type="password" name="password" id="adminPassword" class="form-control @error('password') is-invalid @enderror" value="" placeholder="Enter your password" autocomplete="new-password" required readonly onfocus="this.removeAttribute('readonly');">
                        <button class="btn btn-eye" type="button" id="togglePasswordBtn" onclick="togglePasswordVisibility()" title="Show/Hide Password">
                            <i class="fa-solid fa-eye-slash" id="togglePasswordIcon"></i>
                        </button>
                    </div>
                </div>

                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" id="rememberMe">
                        <label class="form-check-label text-muted small" for="rememberMe">
                            Remember Me
                        </label>
                    </div>
                </div>

                <button type="submit" class="btn btn-gold w-100">
                    <i class="fa-solid fa-right-to-bracket me-2"></i> Sign In to Dashboard
                </button>
            </form>

            <div class="text-center mt-4">
                <a href="{{ url('/') }}" class="text-muted small text-decoration-none">
                    <i class="fa-solid fa-arrow-left me-1"></i> Back to Jay's Beauty Website
                </a>
            </div>
        </div>
    </div>

    <script>
        function togglePasswordVisibility() {
            const passInput = document.getElementById('adminPassword');
            const passIcon = document.getElementById('togglePasswordIcon');
            if (passInput.type === 'password') {
                passInput.type = 'text';
                passIcon.classList.remove('fa-eye-slash');
                passIcon.classList.add('fa-eye');
                passIcon.style.color = '#c59d5f';
            } else {
                passInput.type = 'password';
                passIcon.classList.remove('fa-eye');
                passIcon.classList.add('fa-eye-slash');
                passIcon.style.color = '';
            }
        }

        // Prevent browser from auto-filling credentials on load
        window.addEventListener('pageshow', function() {
            setTimeout(function() {
                const emailInput = document.getElementById('adminEmail');
                const passwordInput = document.getElementById('adminPassword');
                if (emailInput && !emailInput.matches(':focus')) emailInput.value = '';
                if (passwordInput && !passwordInput.matches(':focus')) passwordInput.value = '';
            }, 60);
        });
    </script>
</body>
</html>
