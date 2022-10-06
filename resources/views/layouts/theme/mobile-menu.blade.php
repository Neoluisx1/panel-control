<div class="mobile-menu md:hidden">

    <div class="mobile-menu-bar">

        <a href="" class="flex mr-auto">

            <img alt="logo " class="w-6" src="{{asset('dist/images/logo.svg')}}">

        </a>

        <a href="javascript:;" id="mobile-menu-toggler"> <i data-feather="bar-chart-2" class="w-8 h-8 text-white transform -rotate-90"></i> </a>
    </div>

    <ul class="border-t border-theme-29 py-5 hidden">
    <li>
        <a href="#" class="menu">
            <div class="side-menu__icon"> <i data-feather="layers"></i> </div>
            <div class="side-menu__title"> Categorias </div>
        </a>
    </li>
    <li>
        <a href="#" class="menu">
            <div class="side-menu__icon"> <i data-feather="coffee"></i> </div>
            <div class="side-menu__title"> Productos </div>
        </a>
    </li>
                    <li>
                        <a href="#" class="menu">
                            <div class="menu__icon"> <i data-feather="plus-circle"></i> </div>
                            <div class="menu__title"> Compras </div>
                        </a>
                    </li>

                    <div class="side-nav__devider my-6"></div>
                    <li>
                        <a href="#" class="menu">
                            <div class="menu__icon"> <i data-feather="user"></i> </div>
                            <div class="menu__title"> Clientes </div>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="menu">
                            <div class="menu__icon"> <i data-feather="key"></i> </div>
                            <div class="menu__title"> Usuarios </div>
                        </a>
                    </li>
                    <div class="side-nav__devider my-6"></div>
                    <li>
                        <a href="#" class="menu">
                            <div class="menu__icon"> <i data-feather="calendar"></i> </div>
                            <div class="menu__title"> Reportes </div>
                        </a>
                    </li>
                    <div class="side-nav__devider my-6"></div>
                    <li>
                        <a href="{{ route('settings') }}" class="side-menu">
                            <div class="side-menu__icon"> <i data-feather="settings"></i> </div>
                            <div class="side-menu__title"> Configuraciones </div>
                        </a>
                    </li>

    </ul>
</div>
