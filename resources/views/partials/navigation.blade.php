<nav class="navbar navbar-expand-lg py-2 px-4" id="navbar-top">
    <div class="d-flex align-items-center text-white">
        <h2 class="fs-3 m-0">Career Advancement Navigator</h2>
    </div>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle Navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
            <li class="nav-item-dropdown">
                <a href="/login" class="text-white fs-5 fw-normal text-decoration-none px-1 {{ Request::path() == 'login' ? 'active' : '' }}">Login</a>
                <a href="/register" class="text-white fs-5 fw-normal text-decoration-none px-1 {{ Request::path() == 'register' ? 'active' : '' }}">Register</a>
                <a href="/attendance" class="text-white fs-5 fw-normal text-decoration-none px-1 {{ Request::path() == 'attendance' ? 'active' : '' }}">Attendance</a>
            </li>
        </ul>
    </div>
</nav>