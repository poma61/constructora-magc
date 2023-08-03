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
                 <img class="user_img"
                     src="{{ asset('storage/'.$user_all->foto) }}"
                     alt="" height="100" width="100" />
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
                         <i class="as-icon bi bi-4-square"></i> <span class="mtext">Inicio</span>
                     </a>
                 </li>
                 <li>
                     <div class="unfold-divider"></div>
                 </li>


                 <li class="unfold">
                     <a href="javascript:;" class="unfold-toggle">
                         <i class="as-icon bi bi-aspect-ratio"></i><span class="mtext">Forms</span>
                     </a>
                     <ul class="submenu">
                         <li>
                             <a href="#">
                                 <i class="bi bi-aspect-ratio"></i><span> Form Basic</span>
                             </a>
                         </li>
                         <li>
                             <a href="#">
                                 <i class="bi bi-aspect-ratio"></i><span> Form Basic</span>
                             </a>
                         </li>
                         <li>
                             <a href="#">
                                 <i class="bi bi-aspect-ratio"></i><span> Form Basic</span>
                             </a>
                         </li>

                     </ul>
                 </li>


                 <li>
                     <a href="calendar.html" class="unfold-toggle no-arrow">
                         <span class="as-icon bi bi-calendar4-week"></span><span class="mtext">Calendar</span>
                     </a>
                 </li>
                 <li>
                     <div class="unfold-divider"></div>
                 </li>
                 <li>
                     <div class="sidebar-small-cap">Extra</div>
                 </li>

                 <li>
                     <a href="{{ route('r-personal-index-view', 'Santa-Cruz') }}" class="unfold-toggle no-arrow">
                         <span class="as-icon bi bi-person-bounding-box"></span><span class="mtext">Personal</span>
                     </a>
                 </li>

                 <li>
                     <a href="{{ route('r-user-view', 'Santa-Cruz') }}" class="unfold-toggle no-arrow">
                         <span class="as-icon bi bi-people"></span><span class="mtext">Usuarios</span>
                     </a>
                 </li>

             </ul>
         </div>
     </div>
 </div>

 <div class="mobile-menu-overlay"></div>
