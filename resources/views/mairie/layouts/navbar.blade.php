<header class="mdc-top-app-bar" style="background-color: #ff8800;">
        <div class="mdc-top-app-bar__row">
          <div class="mdc-top-app-bar__section mdc-top-app-bar__section--align-start">
            <button class="material-icons mdc-top-app-bar__navigation-icon mdc-icon-button sidebar-toggler" style="color: white">menu</button>
          </div>
          <div class="mdc-top-app-bar__section mdc-top-app-bar__section--align-end mdc-top-app-bar__section-right">
            <div class="menu-button-container menu-profile d-none d-md-block">
              <button class="mdc-button mdc-menu-button">
                <span class="d-flex align-items-center">
                  <span class="figure">
                    @if (Auth::guard('mairie')->user()->name === 'yopougon')
                        <img src="{{ asset('assets/images/profiles/yopougon.png') }}" alt="Logo Yopougon"  class="user" />
                        @elseif (Auth::guard('mairie')->user()->name === 'marcory')
                        <img src="{{ asset('assets/images/profiles/marcory.png') }}" alt="Logo Marcory"  class="user" />
                        @elseif (Auth::guard('mairie')->user()->name === 'cocody')
                        <img src="{{ asset('assets/images/profiles/cocody.png') }}" alt="Logo Cocody"  class="user" />
                        @elseif (Auth::guard('mairie')->user()->name === 'abobo')
                        <img src="{{ asset('assets/images/profiles/abobo.png') }}" alt="Logo Abobo"  class="user" />
                        @elseif (Auth::guard('mairie')->user()->name === 'koumassi')
                        <img src="{{ asset('assets/images/profiles/koumassi.png') }}" alt="Logo Koumassi"  class="user" />
                        @elseif (Auth::guard('mairie')->user()->name === 'port-bouet')
                        <img src="{{ asset('assets/images/profiles/portbouet.png') }}" alt="Logo Port-Bouët"  class="user" />
                        @elseif (Auth::guard('mairie')->user()->name === 'treichville')
                        <img src="{{ asset('assets/images/profiles/treichville.png') }}" alt="Logo Treichville"  class="user" />
                        @elseif (Auth::guard('mairie')->user()->name === 'attecoube')
                        <img src="{{ asset('assets/images/profiles/attecoube.png') }}" alt="Logo Attécoubé"  class="user" />
                        @elseif (Auth::guard('mairie')->user()->name === 'adjame')
                        <img src="{{ asset('assets/images/profiles/adjame.jpg') }}" alt="Logo Adjamé"  class="user" />
                        @elseif (Auth::guard('mairie')->user()->name === 'songon')
                        <img src="{{ asset('assets/images/profiles/songon.png') }}" alt="Logo Songon"  class="user" />
                        @elseif (Auth::guard('mairie')->user()->name === 'plateau')
                        <img src="{{ asset('assets/images/profiles/plateau.jpeg') }}" alt="Logo Songon"  class="user" />
                        @else
                        <img src="{{ asset('assets/images/logo.svg') }}" alt="Logo par défaut"  class="user" />
                    @endif
                  </span>
                  <span class="user-name"  style="color: white; font-size:20px; font-weight:bold">Mairie : {{Auth::guard('mairie')->user()->name}} </span>
                </span>
              </button>
              <div class="mdc-menu mdc-menu-surface" tabindex="-1">
                <ul class="mdc-list" role="menu" aria-hidden="true" aria-orientation="vertical">
                  <li>
                    <a href="" class="mdc-list-item" role="menuitem">
                      <div class="item-thumbnail item-thumbnail-icon-only">
                        <i class="mdi mdi-home-edit-outline text-primary"></i>
                      </div>
                      <div class="item-content d-flex align-items-start flex-column justify-content-center">
                        <h6 class="item-subject font-weight-normal">Mon compte</h6>
                      </div>
                    </a>
                  </li>
                  <li>
                    <a href="{{route('mairie.logout')}}" class="mdc-list-item" role="menuitem">
                      <div class="item-thumbnail item-thumbnail-icon-only">
                        <i class="mdi mdi-logout text-primary"></i>                      
                      </div>
                      <div class="item-content d-flex align-items-start flex-column justify-content-center">
                        <h6 class="item-subject font-weight-normal">Déconnexion</h6>
                      </div>
                    </a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </header>