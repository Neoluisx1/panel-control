<nav class="side-nav">
                <a href="{{ route('dash') }}" class="intro-x flex items-center pl-5 pt-4">
                    <img alt="logo" class="w-30" src="{{asset('dist/images/logo2.png')}}">
                    <span class="hidden xl:block text-white text-lg ml-3"><span class="font-medium"></span> </span>
                </a>
                <div class="side-nav__devider my-6"></div>
                <ul>
                    <li>
                        <a href="{{ route('categories') }}" class="side-menu">
                            <div class="side-menu__icon"> <i data-feather="layers"></i> </div>
                            <div class="side-menu__title"> Categorias </div>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('products') }}" class="side-menu {{ (Request::segment(1) == 'products') ? 'side-menu--active side-menu--open' : ''}}">
                            <div class="side-menu__icon"> <i data-feather="coffee"></i> </div>
                            <div class="side-menu__title"> Productos </div>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:;" class="side-menu {{ ((Request::segment(1) == 'purchases')|| (Request::segment(1) == 'purchases_add')) ? 'side-menu--active side-menu--open' : ''}}">
                            <div class="side-menu__icon"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-box"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path><polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline><line x1="12" y1="22.08" x2="12" y2="12"></line></svg> </div>
                            <div class="side-menu__title">
                                Compras
                                <div class="side-menu__sub-icon"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down"><polyline points="6 9 12 15 18 9"></polyline></svg> </div>
                            </div>
                        </a>
                        <ul class="{{ ((Request::segment(1) == 'purchases') || (Request::segment(1) == 'purchases_add')) ? 'side-menu__sub-open' : ''}}">
                            <li>
                                <a href="{{ route('purchases') }}" class="side-menu">
                                    <div class="side-menu__icon"> <i data-feather="list"></i> </div>
                                    <div class="side-menu__title"> Lista de Compras</div>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('purchases_add') }}" class="side-menu">
                                    <div class="side-menu__icon"> <i data-feather="plus"></i></div>
                                    <div class="side-menu__title"> Añadir Compra </div>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <div class="side-nav__devider my-6"></div>
                    <li>
                        <a href="{{ route('customers') }}" class="side-menu">
                            <div class="side-menu__icon"> <i data-feather="user"></i> </div>
                            <div class="side-menu__title"> Clientes </div>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('users') }}" class="side-menu">
                            <div class="side-menu__icon"> <i data-feather="key"></i> </div>
                            <div class="side-menu__title"> Usuarios </div>
                        </a>
                    </li>
                    <div class="side-nav__devider my-6"></div>
                    <li>
                        <a href="{{ route('reports') }}" class="side-menu">
                            <div class="side-menu__icon"> <i data-feather="calendar"></i> </div>
                            <div class="side-menu__title"> Reportes </div>
                        </a>
                    </li>
                    <div class="side-nav__devider my-6"></div>
                    <li>
                        <a href="javascript:;" class="side-menu {{ ((Request::segment(1) == 'settings'))||((Request::segment(1) == 'providers')) ? 'side-menu--active side-menu--open' : ''}}">
                            <div class="side-menu__icon"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-box"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path><polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline><line x1="12" y1="22.08" x2="12" y2="12"></line></svg> </div>
                            <div class="side-menu__title">
                                Configuraciones
                                <div class="side-menu__sub-icon"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down"><polyline points="6 9 12 15 18 9"></polyline></svg> </div>
                            </div>
                        </a>
                        <ul class="{{ (Request::segment(1) == 'settings') ? 'side-menu__sub-open' : ''}} {{ (Request::segment(1) == 'providers') ? 'side-menu__sub-open' : ''}}">
                            <li>
                                <a href="{{ route('settings') }}" class="side-menu">
                                    <div class="side-menu__icon"> <i data-feather="list"></i> </div>
                                    <div class="side-menu__title"> Configuraciones</div>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('providers') }}" class="side-menu">
                                    <div class="side-menu__icon"> <i data-feather="plus"></i></div>
                                    <div class="side-menu__title"> Proveedores </div>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="{{ route('branch_offices') }}" class="side-menu">
                            <div class="side-menu__icon"> <i data-feather="settings"></i> </div>
                            <div class="side-menu__title"> Sucursales </div>
                        </a>
                    </li>
                </ul>
            </nav>
