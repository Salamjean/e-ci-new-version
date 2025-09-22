<aside class="mdc-drawer mdc-drawer--dismissible mdc-drawer--open" style="background-color: red">
      <div class="mdc-drawer__header" >
        <a href="{{route('mairie.dashboard')}}" class="brand-logo">
          @if (Auth::guard('mairie')->user()->name === 'yopougon')
                        <img src="{{ asset('assets/images/profiles/yopougon.png') }}" alt="Logo Yopougon" style="width: 50%;" />
                        @elseif (Auth::guard('mairie')->user()->name === 'marcory')
                        <img src="{{ asset('assets/images/profiles/marcory.png') }}" alt="Logo Marcory" style="width: 50%;" />
                        @elseif (Auth::guard('mairie')->user()->name === 'cocody')
                        <img src="{{ asset('assets/images/profiles/cocody.png') }}" alt="Logo Cocody" style="width: 50%;" />
                        @elseif (Auth::guard('mairie')->user()->name === 'abobo')
                        <img src="{{ asset('assets/images/profiles/abobo.png') }}" alt="Logo Abobo" style="width: 50%;" />
                        @elseif (Auth::guard('mairie')->user()->name === 'koumassi')
                        <img src="{{ asset('assets/images/profiles/koumassi.png') }}" alt="Logo Koumassi" style="width: 50%;" />
                        @elseif (Auth::guard('mairie')->user()->name === 'port-bouet')
                        <img src="{{ asset('assets/images/profiles/portbouet.png') }}" alt="Logo Port-Bouët" style="width: 50%;" />
                        @elseif (Auth::guard('mairie')->user()->name === 'treichville')
                        <img src="{{ asset('assets/images/profiles/treichville.png') }}" alt="Logo Treichville" style="width: 50%;" />
                        @elseif (Auth::guard('mairie')->user()->name === 'attecoube')
                        <img src="{{ asset('assets/images/profiles/attecoube.png') }}" alt="Logo Attécoubé" style="width: 50%;" />
                        @elseif (Auth::guard('mairie')->user()->name === 'adjame')
                        <img src="{{ asset('assets/images/profiles/adjame.jpg') }}" alt="Logo Adjamé" style="width: 50%;" />
                        @elseif (Auth::guard('mairie')->user()->name === 'songon')
                        <img src="{{ asset('assets/images/profiles/songon.png') }}" alt="Logo Songon" style="width: 50%;" />
                        @elseif (Auth::guard('mairie')->user()->name === 'plateau')
                        <img src="{{ asset('assets/images/profiles/plateau.jpeg') }}" alt="Logo Songon" style="width: 50%;" />
                        @else
                        <img src="{{ asset('assets/images/logo.svg') }}" alt="Logo par défaut" style="width: 50%;" />
                    @endif
        </a>
      </div>
      <div class="mdc-drawer__content">
        <div class="user-info">
          <p class="name text-center">Mairie : {{Auth::guard('mairie')->user()->name}} </p>
          <p class="email text-center">{{Auth::guard('mairie')->user()->email}}</p>
        </div>
        <div class="mdc-list-group">
          <nav class="mdc-list mdc-drawer-menu">
            <div class="mdc-list-item mdc-drawer-item">
              <a class="mdc-drawer-link" href="{{route('mairie.dashboard')}}">
                <i class="material-icons mdc-list-item__start-detail mdc-drawer-item-icon" aria-hidden="true">home</i>
                Tableau de bord
              </a>
            </div>
            <hr style="color: white">
            <hr style="color: white">
            <div class="mdc-list-item mdc-drawer-item">
              <a class="mdc-expansion-panel-link" href="#" data-toggle="expansionPanel" data-target="ui-sub-menu">
                <i class="material-icons mdc-list-item__start-detail mdc-drawer-item-icon" aria-hidden="true">home</i>
                Etat civil
                <i class="mdc-drawer-arrow material-icons">chevron_right</i>
              </a>
              <div class="mdc-expansion-panel" id="ui-sub-menu">
                <nav class="mdc-list mdc-drawer-submenu">
                  <div class="mdc-list-item mdc-drawer-item">
                    <a class="mdc-drawer-link" href="{{route('mairie.state.create')}}">
                      Ajout du service
                    </a>
                  </div>
                  <div class="mdc-list-item mdc-drawer-item">
                    <a class="mdc-drawer-link" href="{{route('mairie.state.index')}}">
                     Informations
                    </a>
                  </div>
                </nav>
              </div>
            </div>

             <div class="mdc-list-item mdc-drawer-item">
              <a class="mdc-expansion-panel-link" href="#" data-toggle="expansionPanel" data-target="sample-page-submenu">
                <i class="material-icons mdc-list-item__start-detail mdc-drawer-item-icon" aria-hidden="true">monetization_on</i>
                Finance
                <i class="mdc-drawer-arrow material-icons">chevron_right</i>
              </a>
              <div class="mdc-expansion-panel" id="sample-page-submenu">
                <nav class="mdc-list mdc-drawer-submenu">
                  <div class="mdc-list-item mdc-drawer-item">
                    <a class="mdc-drawer-link" href="{{route('mairie.finance.create')}}">
                     Ajout du service
                    </a>
                  </div>
                  <div class="mdc-list-item mdc-drawer-item">
                    <a class="mdc-drawer-link" href="{{route('mairie.finance.index')}}">
                      Informations
                    </a>
                  </div>
                </nav>
              </div>
            </div>
              <hr style="color: white">
              <hr style="color: white">
            <div class="mdc-list-item mdc-drawer-item">
              <a class="mdc-drawer-link" href="{{route('mairie.request.birth')}}">
                <i class="material-icons mdc-list-item__start-detail mdc-drawer-item-icon" aria-hidden="true">child_care</i>
                Extrait Naissance
              </a>
            </div>
            <div class="mdc-list-item mdc-drawer-item">
              <a class="mdc-drawer-link" href="{{route('mairie.request.death')}}">
                <i class="material-icons mdc-list-item__start-detail mdc-drawer-item-icon" aria-hidden="true">spa</i>
                Extrait Décès
              </a>
            </div>
            <div class="mdc-list-item mdc-drawer-item">
              <a class="mdc-drawer-link" href="{{route('mairie.request.wedding')}}">
                <i class="material-icons mdc-list-item__start-detail mdc-drawer-item-icon" aria-hidden="true">favorite</i>
                Extrait Mariage
              </a>
            </div>
    </aside>