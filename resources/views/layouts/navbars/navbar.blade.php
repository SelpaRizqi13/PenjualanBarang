<!-- Top navbar -->
<nav class="navbar navbar-top navbar-expand-md navbar-dark"  id="navbar-main" style="background: linear-gradient(135deg,rgba(252,185,0,1) 0%,rgba(255,105,0,1) 100%)">
    <div class="container-fluid">
        <!-- Brand -->
        <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" ></a>
        <!-- Form -->
        <form class="navbar-search navbar-search-dark form-inline mr-3 d-none d-md-flex ml-lg-auto">
            <div class="form-group mb-0">
                
            </div>
        </form>
        <!-- User -->
        <ul class="navbar-nav align-items-center d-none d-md-flex">
            <li class="nav-item dropdown">
                <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <div class="media align-items-center">
                        <span class="avatar avatar-sm rounded-circle">
                            <img alt="Image placeholder" src="{{ asset('argon') }}/img/theme/team-4-800x800.jpg">
                        </span>
                        <div class="media-body ml-2 d-none d-lg-block">
                            <span class="mb-0 text-sm  font-weight-bold">selpa</span>
                        </div>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
                    <form role="form" method="post" action="/logout" id="logout-form">
                        @csrf
                        <button type="submit" class="dropdown-item"><i class="ni ni-user-run"></i></i>
                            Logout</button>
                    </form>
                </div>
            </li>
        </ul>
    </div>
</nav>