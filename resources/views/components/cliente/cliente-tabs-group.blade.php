{{-- lista todos los grupos disponibles => 01, 02, 03, 04 --}}
<div class="tabs is-centered">
    <ul>
        @foreach ($manage_groups as $group)
            <li class="{{ $grupo_active == $group ? 'is-active' : '' }}">
                <a href="{{ route('r-tablero-cliente-grupo-view', [$city, $group]) }}">
                    <span>Grupo</span>
                    <span class="icon is-normal">
                        {{-- ltrim => para quitar los ceros por delante de un numero  --}}
                        <i class="is-size-5 {{ 'mdi mdi-numeric-' . ltrim($group, '0') . '-box-outline' }}"
                            aria-hidden="true"></i>
                    </span>
                </a>
            </li>
        @endforeach
    </ul>
</div>
