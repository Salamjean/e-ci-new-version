<aside class="mdc-drawer mdc-drawer--dismissible mdc-drawer--open" style="background-color: red">
      <div class="mdc-drawer__header" >
        <a href="{{route('comptable.dashboard')}}" class="brand-logo">
            @if (Auth::guard('comptable')->user()->communeM === 'yopougon')
                        <img src="{{ asset('assets/images/profiles/yopougon.png') }}" alt="Logo Yopougon" style="width: 50%;" />
                        @elseif (Auth::guard('comptable')->user()->communeM === 'marcory')
                        <img src="{{ asset('assets/images/profiles/marcory.png') }}" alt="Logo Marcory" style="width: 50%;" />
                        @elseif (Auth::guard('comptable')->user()->communeM === 'cocody')
                        <img src="{{ asset('assets/images/profiles/cocody.png') }}" alt="Logo Cocody" style="width: 50%;" />
                        @elseif (Auth::guard('comptable')->user()->communeM === 'abobo')
                        <img src="{{ asset('assets/images/profiles/abobo.png') }}" alt="Logo Abobo" style="width: 50%;" />
                        @elseif (Auth::guard('comptable')->user()->communeM === 'koumassi')
                        <img src="{{ asset('assets/images/profiles/koumassi.png') }}" alt="Logo Koumassi" style="width: 50%;" />
                        @elseif (Auth::guard('comptable')->user()->communeM === 'port-bouet')
                        <img src="{{ asset('assets/images/profiles/portbouet.png') }}" alt="Logo Port-Bouët" style="width: 50%;" />
                        @elseif (Auth::guard('comptable')->user()->communeM === 'treichville')
                        <img src="{{ asset('assets/images/profiles/treichville.png') }}" alt="Logo Treichville" style="width: 50%;" />
                        @elseif (Auth::guard('comptable')->user()->communeM === 'attecoube')
                        <img src="{{ asset('assets/images/profiles/attecoube.png') }}" alt="Logo Attécoubé" style="width: 50%;" />
                        @elseif (Auth::guard('comptable')->user()->communeM === 'adjame')
                        <img src="{{ asset('assets/images/profiles/adjame.jpg') }}" alt="Logo Adjamé" style="width: 50%;" />
                        @elseif (Auth::guard('comptable')->user()->communeM === 'songon')
                        <img src="{{ asset('assets/images/profiles/songon.png') }}" alt="Logo Songon" style="width: 50%;" />
                        @elseif (Auth::guard('comptable')->user()->communeM === 'plateau')
                        <img src="{{ asset('assets/images/profiles/plateau.jpeg') }}" alt="Logo Songon" style="width: 50%;" />
                        @else
                        <img src="{{ asset('assets/images/logo.svg') }}" alt="Logo par défaut" style="width: 50%;" />
                    @endif
        </a>
      </div>
      <div class="mdc-drawer__content">
        <div class="user-info">
          <p class="name text-center">Mairie : {{Auth::guard('comptable')->user()->commune}} </p>
        </div>
        <div class="mdc-list-group">
          <nav class="mdc-list mdc-drawer-menu">
            <div class="mdc-list-item mdc-drawer-item">
              <a class="mdc-drawer-link" href="{{route('comptable.dashboard')}}">
                <i class="material-icons mdc-list-item__start-detail mdc-drawer-item-icon" aria-hidden="true">home</i>
                Tableau de bord
              </a>
            </div>
            <hr style="color: white">
            <hr style="color: white">
            <div class="mdc-list-item mdc-drawer-item">
              <a class="mdc-drawer-link" href="{{route('timbre.create')}}">
                <i class="material-icons mdc-list-item__start-detail mdc-drawer-item-icon" aria-hidden="true">child_care</i>
                Vente de timbre
              </a>
            </div>
            <div class="mdc-list-item mdc-drawer-item">
              <a class="mdc-drawer-link" href="{{route('comptable.timbre.history')}}">
                <i class="material-icons mdc-list-item__start-detail mdc-drawer-item-icon" aria-hidden="true">spa</i>
                Historique de ventes
              </a>
            </div>
            {{-- <div class="mdc-list-item mdc-drawer-item">
              <a class="mdc-drawer-link" href="#">
                <i class="material-icons mdc-list-item__start-detail mdc-drawer-item-icon" aria-hidden="true">favorite</i>
                Extrait Mariage
              </a>
            </div>
              <hr style="color: white">
              <hr style="color: white">
            <div class="mdc-list-item mdc-drawer-item">
              <a class="mdc-expansion-panel-link" href="#" data-toggle="expansionPanel" data-target="ui-sub-menu">
                <i class="material-icons mdc-list-item__start-detail mdc-drawer-item-icon" aria-hidden="true">menu</i>
                Historiques
                <i class="mdc-drawer-arrow material-icons">chevron_right</i>
              </a>
              <div class="mdc-expansion-panel" id="ui-sub-menu">
                <nav class="mdc-list mdc-drawer-submenu">
                  <div class="mdc-list-item mdc-drawer-item">
                    <a class="mdc-drawer-link" href="#">
                     Terminées 
                    </a>
                  </div>
                  <div class="mdc-list-item mdc-drawer-item">
                    <a class="mdc-drawer-link" href="#">
                     Livrées
                    </a>
                  </div>
                </nav>
              </div>
            </div> --}}
            {{-- <div class="mdc-list-item mdc-drawer-item">
              <a class="mdc-expansion-panel-link" href="#" data-toggle="expansionPanel" data-target="sample-page-submenu">
                <i class="material-icons mdc-list-item__start-detail mdc-drawer-item-icon" aria-hidden="true">pages</i>
                Sample Pages
                <i class="mdc-drawer-arrow material-icons">chevron_right</i>
              </a>
              <div class="mdc-expansion-panel" id="sample-page-submenu">
                <nav class="mdc-list mdc-drawer-submenu">
                  <div class="mdc-list-item mdc-drawer-item">
                    <a class="mdc-drawer-link" href="pages/samples/blank-page.html">
                      Blank Page
                    </a>
                  </div>
                  <div class="mdc-list-item mdc-drawer-item">
                    <a class="mdc-drawer-link" href="pages/samples/403.html">
                      403
                    </a>
                  </div>
                  <div class="mdc-list-item mdc-drawer-item">
                    <a class="mdc-drawer-link" href="pages/samples/404.html">
                      404
                    </a>
                  </div>
                  <div class="mdc-list-item mdc-drawer-item">
                    <a class="mdc-drawer-link" href="pages/samples/500.html">
                      500
                    </a>
                  </div>
                  <div class="mdc-list-item mdc-drawer-item">
                    <a class="mdc-drawer-link" href="pages/samples/505.html">
                      505
                    </a>
                  </div>
                  <div class="mdc-list-item mdc-drawer-item">
                    <a class="mdc-drawer-link" href="pages/samples/login.html">
                      Login
                    </a>
                  </div>
                  <div class="mdc-list-item mdc-drawer-item">
                    <a class="mdc-drawer-link" href="pages/samples/register.html">
                      Register
                    </a>
                  </div>
                </nav>
              </div> --}}
            </div>
    </aside>