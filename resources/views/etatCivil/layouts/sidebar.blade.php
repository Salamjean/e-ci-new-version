<aside class="mdc-drawer mdc-drawer--dismissible mdc-drawer--open" style="background-color: red">
      <div class="mdc-drawer__header" >
        <a href="{{route('etat_civil.dashboard')}}" class="brand-logo">
            @if (Auth::guard('etatCivil')->user()->mairie->name === 'yopougon')
                        <img src="{{ asset('assets/images/profiles/yopougon.png') }}" alt="Logo Yopougon" style="width: 50%;" />
                        @elseif (Auth::guard('etatCivil')->user()->mairie->name === 'marcory')
                        <img src="{{ asset('assets/images/profiles/marcory.png') }}" alt="Logo Marcory" style="width: 50%;" />
                        @elseif (Auth::guard('etatCivil')->user()->mairie->name === 'cocody')
                        <img src="{{ asset('assets/images/profiles/cocody.png') }}" alt="Logo Cocody" style="width: 50%;" />
                        @elseif (Auth::guard('etatCivil')->user()->mairie->name === 'abobo')
                        <img src="{{ asset('assets/images/profiles/abobo.png') }}" alt="Logo Abobo" style="width: 50%;" />
                        @elseif (Auth::guard('etatCivil')->user()->mairie->name === 'koumassi')
                        <img src="{{ asset('assets/images/profiles/koumassi.png') }}" alt="Logo Koumassi" style="width: 50%;" />
                        @elseif (Auth::guard('etatCivil')->user()->mairie->name === 'port-bouet')
                        <img src="{{ asset('assets/images/profiles/portbouet.png') }}" alt="Logo Port-Bouët" style="width: 50%;" />
                        @elseif (Auth::guard('etatCivil')->user()->mairie->name === 'treichville')
                        <img src="{{ asset('assets/images/profiles/treichville.png') }}" alt="Logo Treichville" style="width: 50%;" />
                        @elseif (Auth::guard('etatCivil')->user()->mairie->name === 'attecoube')
                        <img src="{{ asset('assets/images/profiles/attecoube.png') }}" alt="Logo Attécoubé" style="width: 50%;" />
                        @elseif (Auth::guard('etatCivil')->user()->mairie->name === 'adjame')
                        <img src="{{ asset('assets/images/profiles/adjame.jpg') }}" alt="Logo Adjamé" style="width: 50%;" />
                        @elseif (Auth::guard('etatCivil')->user()->mairie->name === 'songon')
                        <img src="{{ asset('assets/images/profiles/songon.png') }}" alt="Logo Songon" style="width: 50%;" />
                        @elseif (Auth::guard('etatCivil')->user()->mairie->name === 'plateau')
                        <img src="{{ asset('assets/images/profiles/plateau.jpeg') }}" alt="Logo Songon" style="width: 50%;" />
                        @else
                        <img src="{{ asset('assets/images/logo.svg') }}" alt="Logo par défaut" style="width: 50%;" />
                    @endif
        </a>
      </div>
      <div class="mdc-drawer__content">
        <div class="user-info">
          <p class="name text-center">Mairie : {{Auth::guard('etatCivil')->user()->commune}} </p>
          <p class="email text-center">{{Auth::guard('etatCivil')->user()->email}}</p>
        </div>
        <div class="mdc-list-group">
          <nav class="mdc-list mdc-drawer-menu">
            <div class="mdc-list-item mdc-drawer-item">
              <a class="mdc-drawer-link" href="{{route('etat_civil.dashboard')}}">
                <i class="material-icons mdc-list-item__start-detail mdc-drawer-item-icon" aria-hidden="true">home</i>
                Tableau de bord
              </a>
            </div>
            <hr style="color: white">
            <hr style="color: white">
            <div class="mdc-list-item mdc-drawer-item">
              <a class="mdc-drawer-link" href="{{route('etat_civil.request.birth')}}">
                <i class="material-icons mdc-list-item__start-detail mdc-drawer-item-icon" aria-hidden="true">child_care</i>
                Extrait Naissance
              </a>
            </div>
            <div class="mdc-list-item mdc-drawer-item">
              <a class="mdc-drawer-link" href="{{route('etat_civil.request.death')}}">
                <i class="material-icons mdc-list-item__start-detail mdc-drawer-item-icon" aria-hidden="true">spa</i>
                Extrait Décès
              </a>
            </div>
            <div class="mdc-list-item mdc-drawer-item">
              <a class="mdc-drawer-link" href="{{route('etat_civil.request.wedding')}}">
                <i class="material-icons mdc-list-item__start-detail mdc-drawer-item-icon" aria-hidden="true">favorite</i>
                Extrait Mariage
              </a>
            </div>
              <hr style="color: white">
              <hr style="color: white">
            <div class="mdc-list-item mdc-drawer-item">
              <a class="mdc-expansion-panel-link" href="#" data-toggle="expansionPanel" data-target="ui-sub-menu">
                <i class="material-icons mdc-list-item__start-detail mdc-drawer-item-icon" aria-hidden="true">personal</i>
                Agent
                <i class="mdc-drawer-arrow material-icons">chevron_right</i>
              </a>
              <div class="mdc-expansion-panel" id="ui-sub-menu">
                <nav class="mdc-list mdc-drawer-submenu">
                  <div class="mdc-list-item mdc-drawer-item">
                    <a class="mdc-drawer-link" href="{{route('etat_civil.agent.state.create')}}">
                      Ajout d'agent
                    </a>
                  </div>
                  <div class="mdc-list-item mdc-drawer-item">
                    <a class="mdc-drawer-link" href="{{route('etat_civil.agent.state.index')}}">
                     Listes des agents
                    </a>
                  </div>
                </nav>
              </div>
            </div>
             <hr style="color: white">
              <hr style="color: white">
            <div class="mdc-list-item mdc-drawer-item">
              <a class="mdc-expansion-panel-link" href="#" data-toggle="expansionPanel" data-target="sample-page-submenu">
                <i class="material-icons mdc-list-item__start-detail mdc-drawer-item-icon" aria-hidden="true">pages</i>
                Historiques
                <i class="mdc-drawer-arrow material-icons">chevron_right</i>
              </a>
              <div class="mdc-expansion-panel" id="sample-page-submenu">
                <nav class="mdc-list mdc-drawer-submenu">
                  <div class="mdc-list-item mdc-drawer-item">
                    <a class="mdc-drawer-link" href="{{route('etat_civil.history.taskend')}}">
                     Terminés
                    </a>
                  </div>
                  <div class="mdc-list-item mdc-drawer-item">
                    <a class="mdc-drawer-link" href="{{route('etat_civil.livree.taskend')}}">
                      Livrés
                    </a>
                  </div>
                </nav>
              </div>
            </div>
    </aside>