<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('inicio') }}">
        <div class="sidebar-brand-icon">
            {{--<i class="fas fa-laugh-wink"></i>--}}
            <img width="50" src="/logo.png" alt="Logo tutor IN">
        </div>
        <div class="sidebar-brand-text mx-3">
            {{ config('app.name', 'TUTOR IN') }}
        </div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('inicio') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>


<!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Funciones
    </div>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#admin"
           aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-users-cog"></i>
            <span>Administradores</span>
        </a>
        <div id="admin" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Acciones :</h6>
                <a class="collapse-item" href="{{ route('admin.index') }}">
                    <i class="fa fa-eye"></i> Ver todos
                </a>
                <a class="collapse-item" href="{{ route('admin.create') }}">
                    <i class="fa fa-pencil-alt"></i> Crear
                </a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
           aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-list"></i>
            <span>Tareas</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Acciones :</h6>
                <a class="collapse-item" href="{{ route('task.index') }}">
                    <i class="fa fa-eye"></i> Ver todas las tareas
                </a>
                <a class="collapse-item" href="{{ route('task.status', $status = 'PUBLISHED') }}"><i
                        class="fa fa-print"></i> ver publicadas</a>
                <a class="collapse-item" href="{{ route('task.status', $status = 'PENDING') }}"><i
                        class="fa fa-exclamation"></i> ver pendientes</a>
                <a class="collapse-item" href="{{ route('task.status', $status = 'DONE') }}"><i
                        class="fa fa-check"></i> ver hecho</a>
                <a class="collapse-item" href="{{ route('task.create') }}">
                    <i class="fa fa-pencil-alt"></i> Crear una tarea
                </a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#consulting" aria-expanded="true"
           aria-controls="collapseUtilities">
            <i class="fas fa-concierge-bell"></i>
            <span>Asesorías</span>
        </a>
        <div id="consulting" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Acciones:</h6>
                <a class="collapse-item" href="{{ route('advisory.index') }}"><i class="fa fa-eye"></i> ver todas
                    las asesorías </a>
                <a class="collapse-item" href="{{ route('advisory.status', $status = 'PUBLISHED') }}"><i
                        class="fa fa-print"></i> ver publicadas</a>
                <a class="collapse-item" href="{{ route('advisory.status', $status = 'PENDING') }}"><i
                        class="fa fa-exclamation"></i> ver pendientes</a>
                <a class="collapse-item" href="{{ route('advisory.status', $status = 'DONE') }}"><i
                        class="fa fa-check"></i> ver hecho</a>
                <a class="collapse-item" href="{{ route('advisory.create') }}"><i class="fa fa-pencil-alt"></i>
                    crear una asesoría </a>
            </div>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#courses_link"
           aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-chalkboard-teacher"></i>
            <span>Cursos</span>
        </a>
        <div id="courses_link" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Acciones:</h6>
                <a class="collapse-item" href="#"><i class="fa fa-eye"></i> ver todas los cursos </a>
                <a class="collapse-item" href="{{ route('courses.status', $status = 'PUBLISHED') }}"><i
                        class="fa fa-print"></i> ver publicadas</a>
                <a class="collapse-item" href="{{ route('courses.status', $status = 'PENDING') }}"><i
                        class="fa fa-exclamation"></i> ver pendientes</a>
                <a class="collapse-item" href="{{ route('courses.status', $status = 'DONE') }}"><i
                        class="fa fa-check"></i> ver hecho</a>
                <a class="collapse-item" href="{{ route('course.create') }}"><i class="fa fa-pencil-alt"></i> crear
                    un curso </a>
            </div>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="#">
            <i class="fas fa-comment"></i>
            <span>Chats</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('pqr.index') }}">
            <i class="fas fa-bomb"></i>
            <span>Peticiones, quejas y reclamos </span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Clientes 
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUsers"
           aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-user-graduate"></i>
            <span>Estudiantes</span>
        </a>
        <div id="collapseUsers" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{ route('students.index') }}"><i class="fa fa-eye"></i> ver todos
                </a>
                <a class="collapse-item" href="{{ route('students.create') }}"><i class="fa fa-pencil-alt"></i>
                    crear </a>
            </div>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#teacher" aria-expanded="true"
           aria-controls="collapseUtilities">
            <i class="fas fa-user-tie"></i>
            <span>Tutores</span>
        </a>
        <div id="teacher" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Acciones:</h6>
                <a class="collapse-item" href="{{ route('teachers.index') }}">
                    <i class="fa fa-eye"></i>Ver todos
                </a>
                <a class="collapse-item" href="{{ route('teacher.status', $status = 'request') }}"><i
                        class="fa fa-exclamation"></i> Pendientes </a>
                <a class="collapse-item" href="{{ route('teacher.status', $status = 'verified') }}"><i
                        class="fa fa-check"></i> Aprobados </a>
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Sistema
    </div>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('category.index') }}">
            <i class="fas fa-tags"></i>
            <span>Categorias</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('tag.index') }}">
            <i class="fas fa-hashtag"></i>
            <span>Etiquetas</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('level.index') }}">
            <i class="fas fa-list-ol"></i>
            <span>Niveles</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('zone.index') }}">
            <i class="fas fa-map"></i>
            <span>Zonas</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">


    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->
