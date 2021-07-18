<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>@yield('title') {{ env("APP_NAME") }}</title>
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Bootstrap icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
        <!-- Google fonts-->
        <link rel="preconnect" href="https://fonts.gstatic.com" />
        <link href="https://fonts.googleapis.com/css2?family=Newsreader:ital,wght@0,600;1,600&amp;display=swap" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css2?family=Mulish:ital,wght@0,300;0,500;0,600;0,700;1,300;1,500;1,600;1,700&amp;display=swap" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,400;1,400&amp;display=swap" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <!-- Note: when deploying, replace "development.js" with "production.min.js". -->
        <link rel="stylesheet" type="text/css" href="{{asset('css/app.css')}}">
    </head>
    <body id="page-top">
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-light fixed-top shadow-sm" id="mainNav">
            <div class="container px-5">
                <a class="navbar-brand fw-bold" href="{{url('/')}}">{{ env("APP_NAME") }}</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    Menu
                    <i class="bi-list"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    @if(Auth::check())
                        <ul class="navbar-nav ms-auto me-4 my-3 my-lg-0">
                            <li class="nav-item"><a class="nav-link me-lg-3" href="javascript:void(0);">Hi, {{ auth()->user()->name }}</a></li>
                            <li class="nav-item"><a class="nav-link me-lg-3" href="javascript:void(0);" id="account_balance">&#8358; {{ accountBalance(auth()->user()->id) }}</a></li>
                            <li class="nav-item"><a class="nav-link me-lg-3" href="{{url('home')}}">Dashboard</a></li>
                            <li class="nav-item"><a class="nav-link me-lg-3" href="{{url('transactions')}}">Transactions</a></li>
                            <li class="nav-item"><a class="nav-link me-lg-3" href="#" onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">Logout</a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    @else
                        <ul class="navbar-nav ms-auto me-4 my-3 my-lg-0">
                            <li class="nav-item"><a class="nav-link me-lg-3" href="#features">Features</a></li>
                            <li class="nav-item"><a class="nav-link me-lg-3" href="{{url('login')}}">Sign In</a></li>
                        </ul>
                        <a href="{{url('register')}}" class="btn btn-primary rounded-pill px-3 mb-2 mb-lg-0">
                            <span class="d-flex align-items-center">
                                <i class="bi-chat-text-fill me-2"></i>
                                <span class="small">Get Started</span>
                            </span>
                        </a>
                    @endif
                </div>
            </div>
        </nav>

        @yield('contents')
        
        <!-- Footer-->
        <footer class="bg-black text-center py-5">
            <div class="container px-5">
                <div class="text-white-50 small">
                    <div class="mb-2">&copy; {{ env("APP_NAME") }} Website 2021. All Rights Reserved.</div>
                    <a href="#!">Privacy</a>
                    <span class="mx-1">&middot;</span>
                    <a href="#!">Terms</a>
                    <span class="mx-1">&middot;</span>
                    <a href="#!">FAQ</a>
                </div>
            </div>
        </footer>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
        <script src="js/scripts.js"></script>
        <script src="{{asset('js/app.js')}}"></script>
        {{-- <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script> --}}

        @if(Auth::check())
        <script type="text/javascript">
            // load balance
            fetchAccountBalance();

            function fetchAccountBalance() {
                // body...
                fetch(`{{url('transactions/balance')}}`, {
                    method: "GET",
                    headers: {
                        'Content-Type': 'application/json',
                    }
                }).then(r => {
                    return r.json();
                }).then(results => {
                    // console.log(results);
                    $("#account_balance").html(`&#8358; ${results.balance}`);
                }).catch(err => {
                    console.log(err);
                });
            }
        </script>
        @endif
        @yield('scripts')
    </body>
</html>
