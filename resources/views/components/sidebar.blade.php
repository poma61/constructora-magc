 <div class="left-side-bar">

     <div class="brand-logo">
         <a href="#">
             <img src="{{ asset('src/images/logo-empresa.jpeg') }}" alt="" width="50" height="50" />
             <span>MAGC</span>
         </a>
         <div class="close-sidebar" data-toggle="left-sidebar-close">
             <i class="ion-close-round"></i>
         </div>
     </div>


     <div class="menu-block">
         <div class="sidebar-menu">
             <div class="user-image-sidebar">
                 @php
                     $user_all = Auth::user()
                         ->onPersonal()
                         ->first();
                 @endphp
                 <img class="user_img" src="{{ asset('storage/' . $user_all->foto) }}" alt="" height="100"
                     width="100" />
                 <span class="user_name">

                     {{ $user_all->nombres }} {{ $user_all->apellido_paterno }} {{ $user_all->apellido_materno }}
                 </span>
             </div>

             <ul id="accordion-menu">

                 <li>
                     <div class="unfold-divider"></div>
                 </li>
                 <li>
                     <div class="sidebar-small-cap">Administracion</div>
                 </li>

                 <li>
                     <a href="{{ route('r-home') }}" class="unfold-toggle no-arrow">
                         <i class="as-icon mdi mdi-home-circle-outline is-size-4"></i>
                         <span>Inicio</span>
                     </a>
                 </li>
                 <li>
                     <a href="{{ route('r-cliente-index-view') }}" class="unfold-toggle no-arrow">
                         <i class="as-icon mdi mdi-table-account is-size-4"></i>
                         <span>Clientes</span>
                     </a>
                 </li>

                  <li>
                     <a href="{{ route('r-contrato-index-view') }}" class="unfold-toggle no-arrow">
                         <i class="as-icon mdi mdi-table-account is-size-4"></i>
                         <span>Contratos</span>
                     </a>
                 </li>

                 @if (Auth::user()->role == 'Administrador')
                     <li>
                         <div class="unfold-divider"></div>
                     </li>
                     <li>
                         <a href="{{ route('r-personal-index-view', 'Santa-Cruz') }}" class="unfold-toggle no-arrow">
                             <span class="as-icon  mdi mdi-badge-account-outline is-size-4"></span>
                             <span>Personal</span>
                         </a>
                     </li>

                     <li>
                         <a href="{{ route('r-user-view', 'Santa-Cruz') }}" class="unfold-toggle no-arrow">
                             <span class="as-icon mdi mdi-home-account is-size-4"></span>
                             <span>Usuarios</span>
                         </a>
                     </li>
                 @endif
             </ul>
         </div>
     </div>
 </div>

 <div class="mobile-menu-overlay"></div>
