<div class="sidebar pe-4 pb-3">
            <nav class="navbar bg-light navbar-light">
                <a href="{{route('admin.dashboard')}}" class="navbar-brand mx-4 mb-3">
                    <h3 class="text-primary"><i class="fa fa-hashtag me-2"></i>Admin</h3>
                </a>
                <div class="d-flex align-items-center ms-4 mb-4">
                    <div class="position-relative">
                        <img class="rounded-circle" src="{{asset('dashboard/img/user.jpg')}}" alt="" style="width: 40px; height: 40px;">
                        <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"></div>
                    </div>
                    <div class="ms-3">
                        <h6 class="mb-0">Jhon Doe</h6>
                        <span>Admin</span>
                    </div>
                </div>
                <div class="navbar-nav w-100">
                    <a href="index.html" class="nav-item nav-link active"><i class="fa fa-tachometer-alt me-2"></i>Dashboard</a>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-laptop me-2"></i>Implementation <br> Partner</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="{{route('ip.create')}}" class="dropdown-item">Create</a>
                            <a href="{{route('ip.list')}}" class="dropdown-item">List</a>
                        </div>
                    </div>
                 
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-laptop me-2"></i>Lots Management</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="{{route('lot.create')}}" class="dropdown-item">Create</a>
                            <a href="{{route('lot.list')}}" class="dropdown-item">List</a>
                        </div>
                    </div>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-laptop me-2"></i>District Management</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="{{route('district.create')}}" class="dropdown-item">Create</a>
                            <a href="{{route('district.list')}}" class="dropdown-item">List</a>
                        </div>
                    </div>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-laptop me-2"></i>Tehsil Management</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="{{route('tehsil.create')}}" class="dropdown-item">Create</a>
                            <a href="{{route('tehsil.list')}}" class="dropdown-item">List</a>
                        </div>
                    </div>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-laptop me-2"></i>UC Management</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="{{route('uc.create')}}" class="dropdown-item">Create</a>
                            <a href="{{route('uc.list')}}" class="dropdown-item">List</a>
                        </div>
                    </div>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-laptop me-2"></i>Area Management</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="{{route('area.create')}}" class="dropdown-item">Create</a>
                            <a href="{{route('area.list')}}" class="dropdown-item">List</a>
                        </div>
                    </div>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-laptop me-2"></i>Form Management</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="{{route('form.create')}}" class="dropdown-item">Create</a>
                            <a href="{{route('form.list')}}" class="dropdown-item">List</a>
                        </div>
                    </div>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-laptop me-2"></i>Role Management</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="{{route('role.create')}}" class="dropdown-item">Create</a>
                            <a href="{{route('role.list')}}" class="dropdown-item">List</a>
                        </div>
                    </div>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-laptop me-2"></i>Logs Management</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="{{route('logs.list')}}" class="dropdown-item">List</a>
                        </div>
                    </div>
                   
                   
             
                </div>
            </nav>
        </div>