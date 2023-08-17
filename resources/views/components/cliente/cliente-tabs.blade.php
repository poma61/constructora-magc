
  <div class="tabs is-centered  is-medium">
      <ul>
          @if ($grupo == 'todos')
              @for ($i = 1; $i <= 10; $i++)
                  <li class="{{ $grupo_active == str_pad($i, 2, '0', STR_PAD_LEFT) ? 'is-active' : null }}">
                      <a href="{{ route('r-tablero-cliente-grupo-view', [$city, str_pad($i, 2, '0', STR_PAD_LEFT)]) }}">
                          <span>Grupo</span>
                          <span class="icon is-normal">
                              <i class="{{ 'mdi mdi-numeric-' . $i . '-box-outline' }}" aria-hidden="true"></i>
                          </span>
                      </a>
                  </li>
              @endfor
          @else
              <li class="is-active">
                  <a href="{{ route('r-tablero-cliente-grupo-view', [$city, $grupo]) }}">
                      <span>Grupo</span>
                      <span class="icon is-normal">
                      {{-- ltrim => para quitar los ceros por delante de un numero  --}}
                          <i class="{{ 'mdi mdi-numeric-' .ltrim($grupo,'0'). '-box-outline' }}" aria-hidden="true"></i>
                      </span>

                  </a>
              </li>
          @endif

      </ul>
  </div>


