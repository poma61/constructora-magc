  <div class="tabs is-centered is-boxed is-medium">
      <ul>
          <li class="{{ $city == 'Santa-Cruz' ? 'is-active' : null }}">
              <a href="{{ route('r-personal-index-view', 'Santa-Cruz') }}">
                  <span class="icon is-small">
                      <i class="bi bi-1-circle" aria-hidden="true"></i>
                  </span>
                  <span>Santa Cruz</span>
              </a>
          </li>

          <li class="{{ $city == 'Chuquisaca' ? 'is-active' : null }}">
              <a href="{{ route('r-personal-index-view', 'Chuquisaca') }}">
                  <span class="icon is-small"><i class="bi bi-2-circle" aria-hidden="true"></i></span>
                  <span>Chuquisaca </span>
              </a>
          </li>

          <li class="{{ $city == 'Cochabamba' ? 'is-active' : null }}">
              <a href="{{ route('r-personal-index-view', 'Cochabamba') }}">
                  <span class="icon is-small"><i class="bi bi-3-circle" aria-hidden="true"></i></span>
                  <span>Cochabamba</span>
              </a>
          </li>

          <li class="{{ $city == 'Potosi' ? 'is-active' : null }}">
              <a href="{{ route('r-personal-index-view', 'Potosi') }}">
                  <span class="icon is-small"><i class="bi bi-4-circle" aria-hidden="true"></i></span>
                  <span>Potosi</span>
              </a>
          </li>

          <li class="{{ $city == 'Beni' ? 'is-active' : null }}">
              <a href="{{ route('r-personal-index-view', 'Beni') }}">
                  <span class="icon is-small"><i class="bi bi-5-circle" aria-hidden="true"></i></span>
                  <span>Beni</span>
              </a>
          </li>

          <li class="{{ $city == 'La-Paz' ? 'is-active' : null }}">
              <a href="{{ route('r-personal-index-view', 'La-Paz') }}">
                  <span class="icon is-small"><i class="bi bi-6-circle" aria-hidden="true"></i></span>
                  <span>La Paz</span>
              </a>
          </li>

          <li class="{{ $city == 'Pando' ? 'is-active' : null }}">
              <a href="{{ route('r-personal-index-view', 'Pando') }}">
                  <span class="icon is-small"><i class="bi bi-7-circle" aria-hidden="true"></i></span>
                  <span>Pando</span>
              </a>
          </li>

          <li class="{{ $city == 'Tarija' ? 'is-active' : null }}">
              <a href="{{ route('r-personal-index-view', 'Tarija') }}">
                  <span class="icon is-small"><i class="bi bi-8-circle" aria-hidden="true"></i></span>
                  <span>Tarija</span>
              </a>
          </li>

          <li class="{{ $city == 'Oruro' ? 'is-active' : null }}">
              <a href="{{ route('r-personal-index-view', 'Oruro') }}">
                  <span class="icon is-small"><i class="bi bi-9-circle" aria-hidden="true"></i></span>
                  <span>Oruro</span>
              </a>
          </li>


    <li class="{{ $city == 'Otros' ? 'is-active' : null }}">
              <a href="{{ route('r-personal-index-view', 'Otros') }}">
                  <span class="icon is-small"><i class="bi bi-0-circle" aria-hidden="true"></i></span>
                  <span>Otros</span>
              </a>
          </li>
      </ul>
  </div>
