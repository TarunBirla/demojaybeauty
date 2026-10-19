<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Database Setup - Jay's Beauty</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: #fdfaf7; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        .card { border-radius: 15px; border: 1px solid #ebd3be; box-shadow: 0 10px 25px rgba(212,163,115,0.15); }
        .btn-gold { background: #d4a373; color: white; font-weight: 600; border-radius: 8px; }
        .btn-gold:hover { background: #b88658; color: white; }
        .creds-box { background: #fff8f0; border-left: 4px solid #d4a373; padding: 15px; border-radius: 5px; }
    </style>
</head>
<body>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card p-4">
                    <div class="text-center mb-4">
                        <h2 style="color: #b88658; font-weight: 700;">Jay's Beauty Database Setup</h2>
                        <p class="text-muted">Safe migration runner & table initializer</p>
                    </div>

                    @if($error)
                        <div class="alert alert-danger">
                            <h5>Error during setup:</h5>
                            <p class="mb-0">{{ $error }}</p>
                        </div>
                    @else
                        <div class="alert alert-success">
                            <h5 class="mb-0">🎉 Database & Tables are Ready!</h5>
                        </div>

                        <div class="mb-4">
                            <h6>Execution Details:</h6>
                            <ul class="list-group mb-3">
                                @foreach($messages as $msg)
                                    <li class="list-group-item">{!! $msg !!}</li>
                                @endforeach
                            </ul>
                        </div>

                        <div class="creds-box mb-4">
                            <h6 class="text-dark fw-bold">🔑 Default Admin Login Credentials:</h6>
                            <p class="mb-1"><strong>Email:</strong> <code>admin@jaysbeauty.co.uk</code></p>
                            <p class="mb-1"><strong>Password:</strong> <code>admin123</code></p>
                            <small class="text-muted">You can change these credentials anytime from the admin panel.</small>
                        </div>

                        <div class="d-flex gap-3">
                            <a href="{{ url('/admin/login') }}" class="btn btn-gold px-4 py-2 flex-grow-1">Go to Admin Login (/admin/login)</a>
                            <a href="{{ url('/') }}" class="btn btn-outline-secondary px-4 py-2">Visit Website (Home)</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</body>
</html>
