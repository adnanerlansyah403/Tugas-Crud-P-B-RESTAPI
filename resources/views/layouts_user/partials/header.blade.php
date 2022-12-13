
        <div class="top">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <ul>
                            <li class="today-text">Today: January 20, 2022</li>
                            <li class="email-text">contact@newsportal</li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <ul class="right">
                            <li class="menu"><a href="faq.html">FAQ</a></li>
                            <li class="menu"><a href="about.html">About</a></li>
                            <li class="menu"><a href="login.html">Login</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="heading-area">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 d-flex align-items-center">
                        <div class="logo">
                            <a href="index.html">
                                <img src="{{ asset('assets/uploads/logo.png') }}" alt="">
                            </a>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="ad-section-1">
                            <a href=""><img src="{{ asset('assets/uploads/ad-1.png') }}" alt=""></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="website-menu">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
                            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                            </button>
                            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                                    <li class="nav-item">
                                        <a href="{{ url('/') }}" class="nav-link active" aria-current="page" href="index.html">Home</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('blogs.index') }}" class="nav-link active" aria-current="page" href="index.html">Blogs</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link active" aria-current="page" href="index.html">Product</a>
                                    </li>
                                    {{-- <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        Sports
                                        </a>
                                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                            <li><a class="dropdown-item" href="#">Football</a></li>
                                            <li><a class="dropdown-item" href="#">Cricket</a></li>
                                            <li><a class="dropdown-item" href="#">Baseball</a></li>
                                        </ul>
                                    </li> --}}
                                </ul>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </div>  