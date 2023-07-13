
<div class="sidebar sidebar-dark sidebar-main sidebar-expand-lg">

    <!-- Sidebar content -->
    <div class="sidebar-content">

        <!-- Sidebar header -->
        <div class="sidebar-section">
            <div class="sidebar-section-body d-flex justify-content-center">
                <h5 class="sidebar-resize-hide flex-grow-1 my-auto">Menu</h5>

                <div>
                    <button type="button" class="btn btn-flat-white btn-icon btn-sm rounded-pill border-transparent sidebar-control sidebar-main-resize d-none d-lg-inline-flex">
                        <i class="ph-arrows-left-right"></i>
                    </button>

                    <button type="button" class="btn btn-flat-white btn-icon btn-sm rounded-pill border-transparent sidebar-mobile-main-toggle d-lg-none">
                        <i class="ph-x"></i>
                    </button>
                </div>
            </div>
        </div>
        <!-- /sidebar header -->


        <!-- Main navigation -->
        <div class="sidebar-section">
            <ul class="nav nav-sidebar" data-nav-type="accordion">

                <!-- Main -->
                <li class="nav-item-header pt-0">
                    <div class="text-uppercase fs-sm lh-sm opacity-50 sidebar-resize-hide">Principal</div>
                    <i class="ph-dots-three sidebar-resize-show"></i>
                </li>
                <li class="nav-item">
                    <a href="{{ route('home') }}" class="nav-link {{ Route::is('home')?'active':'' }}">
                        <i class="ph-house"></i><span>Inicio</span>
                    </a>
                </li>

                @hasanyrole('ADMINISTRADOR')
                    <li class="nav-item">
                        <a href="{{ route('tipo-cuentas.index') }}" class="nav-link {{ Route::is('tipo-cuentas*')?'active':'' }}">
                            <i class="ph-cards"></i><span>Tipo de cuenta</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('tipo-creditos.index') }}" class="nav-link {{ Route::is('tipo-creditos*')?'active':'' }}">
                            <i class="ph ph-currency-circle-dollar"></i><span>Tipo de crédito</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('tipo-transacciones.index') }}" class="nav-link {{ Route::is('tipo-transacciones*')?'active':'' }}">
                            <i class="ph-arrows-left-right"></i><span>Tipo de transación</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('caja.index') }}" class="nav-link {{ Route::is('caja*')?'active':'' }}">
                            <i class="ph ph-vault"></i><span>Caja</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('transacciones.index') }}" class="nav-link {{ Route::is('transacciones*')?'active':'' }}">
                            <i class="ph ph-repeat"></i>
                            <span>
                                Transacciones
                            </span>
                        </a>
                    </li> 

                @endhasanyrole
                @hasanyrole('ADMINISTRADOR|SECRETARIA')
                    <li class="nav-item">
                        <a href="{{ route('usuarios.index') }}" class="nav-link {{ Route::is('usuarios*')?'active':'' }}">
                            <i class="ph-users"></i><span>Usuario</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('cuentas-usuario.index') }}" class="nav-link {{ Route::is('cuentas-usuario*')?'active':'' }}">
                            <i class="ph-credit-card"></i>
                            <span>
                                Cuentas de usuario
                            </span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('creditos.index') }}" class="nav-link {{ Route::is('creditos*')?'active':'' }}">
                            <i class="ph-currency-dollar"></i>
                            <span>
                                Créditos
                            </span>
                        </a>
                    </li>
                    
                    <li class="nav-item">
                        <a href="{{ route('plazo-fijo.index') }}" class="nav-link {{ Route::is('plazo-fijo*')?'active':'' }}">
                            <i class="ph ph-chart-bar"></i>
                            <span>
                                Plazo fijo
                            </span>
                        </a>
                    </li>
                @endhasanyrole

            </ul>
        </div>
        <!-- /main navigation -->

    </div>
    <!-- /sidebar content -->
    
</div>
