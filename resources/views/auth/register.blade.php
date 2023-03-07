<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Register</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset ('admin2/css/sb-admin-2.min.css') }}" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

    <div class="container">

    <div class="row justify-content-center">

    <div class="col-xl-9 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                    <div class="col-lg-12">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                            </div>
                            <form action="{{ route('register-store') }}" class="user" method="post">
                            @csrf
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="text" name="name" class="form-control form-control-user @error('name') is-invalid @enderror" placeholder="Name">
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="username" name="username" class="form-control form-control-user @error('username') is-invalid @enderror" id="exampleLastName"
                                            placeholder="Username">
                                    @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                        <input type="text" name="telp" class="form-control form-control-user @error('telp') is-invalid @enderror"
                                            id="exampleRepeatPassword" placeholder="Telepon">
                                    @error('telp')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="password" name="password" class="form-control form-control-user @error('password') is-invalid @enderror" id="exampleInputEmail"
                                            placeholder="Password">
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                    </div>
                                    
                                    <div class="col-sm-6">
                                        <input type="password" name="passwordshow" class="form-control form-control-user @error('passwordshow') is-invalid @enderror"
                                            id="exampleInputPassword" placeholder="Repeat Password">
                                    @error('passwordshow')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                    </div>
                                </div>  
                                <button class="btn btn-primary btn-user btn-block">
                                    Register
                                </button>
                                <hr>
                            </form>
                            <div class="text-center">
                                <a class="small" href="/login">Already have an account? Login!</a>
                            </div>
                        </div>
                </div>
            </div>
            </div>
        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{ ('admin2/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ ('admin2/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ ('admin2/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ ('admin2/js/sb-admin-2.min.js') }}"></script>

</body>

</html>