<nav class="navbar sticky-top navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">

        <button type="button" id="sidebarCollapse" class="btn btn-dark">
            <i class="fas fa-align-left"></i>
        </button>
        <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fas fa-align-justify"></i>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="nav navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="/teacher/sections">{{$aSession->getData()->first_name}} {{$aSession->getData()->last_name}}</a>
                </li>
            </ul>
            <ul class="nav navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="/logout">Logout</a>
                </li>
            </ul>
        </div>
    </div>
</nav>