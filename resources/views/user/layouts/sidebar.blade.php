<ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar" style="background-color: #ff8800">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{route('user.dashboard')}}">
                 <div class="sidebar-brand-icon rotate-n-10">
                    @if (Auth::user()->commune === 'yopougon')
                        <img src="{{ asset('assets/images/profiles/yopougon.png') }}" alt="Logo Yopougon" style="height: 70px; width: auto;" />
                        @elseif (Auth::user()->commune === 'marcory')
                        <img src="{{ asset('assets/images/profiles/marcory.png') }}" alt="Logo Marcory" style="height: 70px; width: auto;" />
                        @elseif (Auth::user()->commune === 'cocody')
                        <img src="{{ asset('assets/images/profiles/cocody.png') }}" alt="Logo Cocody" style="height: 70px; width: auto;" />
                        @elseif (Auth::user()->commune === 'abobo')
                        <img src="{{ asset('assets/images/profiles/abobo.png') }}" alt="Logo Abobo" style="height: 70px; width: auto;" />
                        @elseif (Auth::user()->commune === 'koumassi')
                        <img src="{{ asset('assets/images/profiles/koumassi.png') }}" alt="Logo Koumassi" style="height: 70px; width: auto;" />
                        @elseif (Auth::user()->commune === 'port-bouet')
                        <img src="{{ asset('assets/images/profiles/portbouet.png') }}" alt="Logo Port-Bouët" style="height: 70px; width: auto;" />
                        @elseif (Auth::user()->commune === 'treichville')
                        <img src="{{ asset('assets/images/profiles/treichville.png') }}" alt="Logo Treichville" style="height: 70px; width: auto;" />
                        @elseif (Auth::user()->commune === 'attecoube')
                        <img src="{{ asset('assets/images/profiles/attecoube.png') }}" alt="Logo Attécoubé" style="height: 70px; width: auto;" />
                        @elseif (Auth::user()->commune === 'adjame')
                        <img src="{{ asset('assets/images/profiles/adjame.jpg') }}" alt="Logo Adjamé" style="height: 70px; width: auto;" />
                        @elseif (Auth::user()->commune === 'songon')
                        <img src="{{ asset('assets/images/profiles/songon.png') }}" alt="Logo Songon" style="height: 70px; width: auto;" />
                        @elseif (Auth::user()->commune === 'plateau')
                        <img src="{{ asset('assets/images/profiles/plateau.jpeg') }}" alt="Logo Songon" style="height: 70px; width: auto;" />
                        @else
                        <img src="{{ asset('assets/images/logo.svg') }}" alt="Logo par défaut" style="height: 70px; width: auto;" />
                    @endif
                </div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="{{route('user.dashboard')}}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Tableau de bord</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Demande d'extrait 
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-home fa-cog"></i>
                    <span>Naissance</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Demande d'extrait:</h6>
                        <a class="collapse-item" href="{{route('user.birth.create')}}">Fais une demande</a>
                        <a class="collapse-item" href="{{route('user.extrait.birth.index')}}">Listes des demandes</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                    aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-fw fa-wrench"></i>
                    <span>Décès</span>
                </a>
                <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Demande d'extrait:</h6>
                        <a class="collapse-item" href="{{route('user.death.create')}}">Fais une demande</a>
                        <a class="collapse-item" href="{{route('user.extrait.death.index')}}">Listes des demandes</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
                    aria-expanded="true" aria-controls="collapsePages">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Mariage</span>
                </a>
                <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Demande d'extrait:</h6>
                        <a class="collapse-item" href="{{route('user.mariage.create')}}">Fais une demande</a>
                        <a class="collapse-item" href="{{route('user.extrait.mariage.index')}}">Listes des demandes</a>
                    </div>
                </div>
            </li>

            {{--<!-- Nav Item - Tables -->
            <li class="nav-item">
                <a class="nav-link" href="tables.html">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Tables</span></a>
            </li> --}}

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>