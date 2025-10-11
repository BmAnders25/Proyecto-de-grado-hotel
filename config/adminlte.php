<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Title
    |--------------------------------------------------------------------------
    |
    | Here you can change the default title of your admin panel.
    |
    | For detailed instructions you can look the title section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'title' => 'S.O.A.H',
    'title_prefix' => '',
    'title_postfix' => '',

    /*
    |--------------------------------------------------------------------------
    | Favicon
    |--------------------------------------------------------------------------
    |
    | Aquí puedes activar el favicon.
    |
    | For detailed instructions you can look the favicon section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'use_ico_only' => true,
    'use_full_favicon' => false,

    /*
    |--------------------------------------------------------------------------
    | Google Fonts
    |--------------------------------------------------------------------------
    |
    | Here you can allow or not the use of external google fonts. Disabling the
    | google fonts may be useful if your admin panel internet access is
    | restricted somehow.
    |
    | For detailed instructions you can look the google fonts section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'google_fonts' => [
        'allowed' => true,
    ],

    /*
    |--------------------------------------------------------------------------
    | Admin Panel Logo
    |--------------------------------------------------------------------------
    |
    | Here you can change the logo of your admin panel.
    |
    | For detailed instructions you can look the logo section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'logo' => '<b>S.O.A.H</b>',
    'logo_img' => 'vendor/adminlte/dist/img/logo.png',
    'logo_img_class' => 'brand-image img-circle elevation-3',
    'logo_img_xl' => null,
    'logo_img_xl_class' => 'brand-image-xs',
    'logo_img_alt' => 'Fralgom Logo',

    /*
    |--------------------------------------------------------------------------
    | Authentication Logo
    |--------------------------------------------------------------------------
    |
    | Here you can setup an alternative logo to use on your login and register
    | screens. When disabled, the admin panel logo will be used instead.
    |
    | For detailed instructions you can look the auth logo section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'auth_logo' => [
        'enabled' => true,
        'img' => [
            'path' => 'vendor/adminlte/dist/img/logo.png',
            'alt' => 'S.O.A.H Logo',
            'class' => '',
            'width' => 50,
            'height' => 50,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Preloader Animation
    |--------------------------------------------------------------------------
    |
    | Here you can change the preloader animation configuration.
    |
    | For detailed instructions you can look the preloader section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'preloader' => [
        'enabled' => false,
        'img' => [
            'path' => 'vendor/adminlte/dist/img/fralgom-icon.png',
            'alt' => 'AdminLTE Preloader Image',
            'effect' => 'animation__shake',
            'width' => 60,
            'height' => 60,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | User Menu
    |--------------------------------------------------------------------------
    |
    | Aquí puedes activar y cambiar el menú de usuario.
    |
    | For detailed instructions you can look the user menu section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'usermenu_enabled' => true,
    'usermenu_header' => false,
    'usermenu_header_class' => 'bg-primary',
    'usermenu_image' => false,
    'usermenu_desc' => false,
    'usermenu_profile_url' => false,

    /*
    |--------------------------------------------------------------------------
    | Layout
    |--------------------------------------------------------------------------
    |
    | Aquí cambiamos el diseño de su panel de administración.
    |
    | For detailed instructions you can look the layout section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'layout_topnav' => null,
    'layout_boxed' => null,
    'layout_fixed_sidebar' => null,
    'layout_fixed_navbar' => null,
    'layout_fixed_footer' => true,
    'layout_dark_mode' => null,

    /*
    |--------------------------------------------------------------------------
    | Authentication Views Classes
    |--------------------------------------------------------------------------
    |
    | Aquí puede cambiar la apariencia y el comportamiento de las vistas de autenticación.
    |
    | For detailed instructions you can look the auth classes section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    // Ejemplos comentados para referencia

    /* Modo oscuro
    'classes_auth_card' => 'bg-gradient-dark',
    'classes_auth_header' => '',
    'classes_auth_body' => 'bg-gradient-dark',
    'classes_auth_footer' => 'text-center',
    'classes_auth_icon' => 'fa-fw text-light',
    'classes_auth_btn' => 'btn-flat btn-light',*/

    /* Tonos azules 
    'classes_auth_card' => '',
    'classes_auth_header' => 'bg-gradient-info',
    'classes_auth_body' => '',
    'classes_auth_footer' => 'text-center',
    'classes_auth_icon' => 'fa-lg text-info',
    'classes_auth_btn' => 'btn-flat btn-primary',*/

    /* predefinido 
    'classes_auth_card' => 'card-outline card-primary',
    'classes_auth_header' => '',
    'classes_auth_body' => '',
    'classes_auth_footer' => '',
    'classes_auth_icon' => '',
    'classes_auth_btn' => 'btn-flat btn-primary',*/

    /* Personalizado 
   'classes_auth_card' => 'bg-gradient-dark',
    'classes_auth_header' => 'bg-gradient-info',
    'classes_auth_body' => 'bg-gradient-dark',
    'classes_auth_footer' => 'text-center',
    'classes_auth_icon' => 'fa-lg text-info',
    'classes_auth_btn' => 'btn-flat btn-primary',*/
    'classes_auth_card' => 'card-outline card-primary',
    'classes_auth_header' => 'bg-gradient-light',
    'classes_auth_body' => 'bg-gradient-dark',
    'classes_auth_footer' => 'text-center',
    'classes_auth_icon' => 'fa-lg text-primary',
    'classes_auth_btn' => 'btn-flat btn-primary',


    /*
    |--------------------------------------------------------------------------
    | Admin Panel Classes
    |--------------------------------------------------------------------------
    |
    | Aquí puede cambiar la apariencia y el comportamiento del panel de administración.
    |
    | For detailed instructions you can look the admin panel classes here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'classes_body' => '',
    'classes_brand' => '',
    'classes_brand_text' => '',
    'classes_content_wrapper' => '',
    'classes_content_header' => '',
    'classes_content' => '',
    'classes_sidebar' => 'sidebar-dark-primary elevation-4',
    'classes_sidebar_nav' => '',
    'classes_topnav' => 'navbar-white navbar-light',
    'classes_topnav_nav' => 'navbar-expand',
    'classes_topnav_container' => 'container',

    /*
    |--------------------------------------------------------------------------
    | Barra lateral
    |--------------------------------------------------------------------------
    |
    | Aquí podemos modificar la barra lateral del panel de administración.
    |
    | For detailed instructions you can look the sidebar section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'sidebar_mini' => 'lg',
    'sidebar_collapse' => false,
    'sidebar_collapse_auto_size' => false,
    'sidebar_collapse_remember' => false,
    'sidebar_collapse_remember_no_transition' => true,
    'sidebar_scrollbar_theme' => 'os-theme-light',
    'sidebar_scrollbar_auto_hide' => 'n',
    'sidebar_nav_accordion' => true,
    'sidebar_nav_animation_speed' => 300,

    /*
    |--------------------------------------------------------------------------
    | Barra lateral de control (barra lateral derecha)
    |--------------------------------------------------------------------------
    |
    | Aquí podemos modificar la barra lateral derecha, también conocida como barra lateral de control del panel de administración.
    |
    | For detailed instructions you can look the right sidebar section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'right_sidebar' => false,
    'right_sidebar_icon' => 'fas fa-cogs',
    'right_sidebar_theme' => 'light',
    'right_sidebar_slide' => true,
    'right_sidebar_push' => true,
    'right_sidebar_scrollbar_theme' => 'os-theme-light',
    'right_sidebar_scrollbar_auto_hide' => 'l',

    /*
    |--------------------------------------------------------------------------
    | URLs
    |--------------------------------------------------------------------------
    |
    | Aquí podemos modificar la configuración de la URL del panel de administración.
    |
    | For detailed instructions you can look the urls section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'use_route_url' => false,
    'dashboard_url' => 'home',
    'logout_url' => 'logout',
    'login_url' => 'login',
    'register_url' => null,
    'password_reset_url' => 'password/reset',
    'password_email_url' => 'password/email',
    'profile_url' => false,

    /*
    |--------------------------------------------------------------------------
    | Laravel Mix
    |--------------------------------------------------------------------------
    |
    | Aquí podemos habilitar la opción Laravel Mix para el panel de administración.
    |
    | For detailed instructions you can look the laravel mix section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Other-Configuration
    |
    */

    'enabled_laravel_mix' => false,
    'laravel_mix_css_path' => 'css/app.css',
    'laravel_mix_js_path' => 'js/app.js',

    /*
    |--------------------------------------------------------------------------
    | Menu Items
    |--------------------------------------------------------------------------
    |
    | Aquí podemos modificar la barra lateral/navegación superior del panel de administración.
    |
    | For detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Menu-Configuration
    |
    */

    'menu' => [
        // Navbar items:
        [
            'type'         => 'navbar-search',
            'text'         => 'Buscar',
            'topnav_right' => true,
        ],
        [
            'type'         => 'fullscreen-widget',
            'topnav_right' => true,
        ],

        // Sidebar items:
        [
            'type' => 'sidebar-menu-search',
            'text' => 'Buscar',
        ],

        [
            'header' => 'Movimientos',
            'classes' => 'bg-secondary text-white',
        ],
        [
            'text'  => 'Checkin',
            'icon_color' => 'cyan',  // Check In
            'route' => 'checkins.index',
            'can' => ['ver-checkins'],
            'icon' => 'fas fa-sign-in-alt',
            'classes' => 'bg-light text-dark',
        ],
        [
            'text' => 'CheckOut',
            'icon_color' => 'yellow',  // Exámenes complementarios
            'route' => 'checkouts.index',
            'can' => ['ver-checkouts'],
            'icon' => 'fas fa-sign-out-alt',
            'classes' => 'bg-light text-dark',
        ],
        [
            'text' => 'Pagos',
            'icon_color' => 'red',
            'route' => 'construccion.index',
            'can' => ['ver-gastos'],
            'icon' => 'fas fa-money-bill-wave',
            'classes' => 'bg-light text-dark',
        ],
        [
            'header' => 'Reservas',
            'classes' => 'bg-secondary text-white',
        ],
        [
            'text' => 'Habitaciones',
            'icon_color' => 'cyan',  // Laboratorio como área crítica, destacado
            'route'  => 'habitaciones.index',
            'can'  => ['ver-habitaciones'],
            'icon' => 'fas fa-bed',
            'classes' => 'bg-light text-dark',
        ],

         [
            'text' => 'Tipo de Habitaciones',
            'icon_color' => 'orange',  // Laboratorio como área crítica, destacado
            'route'  => 'tipo_habitaciones.index',
            'can'  => ['ver-tipo-habitaciones'],
            'icon' => 'fas fa-tags',
            'classes' => 'bg-light text-dark',
        ],
        [
            'text' => 'Reservas',
            'icon_color' => 'yellow',  // Laboratorio como área crítica, destacado
            'route'  => 'reservas.index',
            'can'  => ['ver-reservas'],
            'icon' => 'fas fa-calendar-alt',
            'classes' => 'bg-light text-dark',
        ],
        [
            'text' => 'Cuadre Inventario',
            'icon_color' => 'red',  // Laboratorio como área crítica, destacado
            'route'  => 'construccion.index',
            'can'  => ['ver-gastos'],
            'icon' => 'fas fa-cogs',
            'classes' => 'bg-light text-dark',
        ],
        [
            'text' => 'Activar Cuadre',
            'icon_color' => 'green',  // Laboratorio como área crítica, destacado
            'route'  => 'construccion.index',
            'can'  => ['ver-gastos'],
            'icon' => 'fas fa-toggle-on',
            'classes' => 'bg-light text-dark',
        ],
        [
            'text' => 'Informes',
            'icon' => 'fas fa-chart-line',
            'classes' => 'bg-secondary text-white',
            'submenu' => [
                [
                    'text' => 'Pisos',
                    'icon_color' => 'cyan',  // Inventario de los productos
                    'route' => 'pisos.index',
                    'can' => ['ver-pisos'],
                    'icon' => 'fas fa-building',
                    'classes' => 'bg-light text-dark',
                ],
                [
                    'text' => 'Kardex',
                    'icon_color' => 'yellow',  // Cargos de los pacientes
                    'route' => 'construccion.index',
                    'can' => ['ver-gastos'],
                    'icon' => 'fas fa-stream',
                    'classes' => 'bg-light text-dark',
                ],
                [
                    'text' => 'Cuentas por Pagar',
                    'icon_color' => 'red',  // Cargos de los pacientes
                    'route' => 'construccion.index',
                    'can' => ['ver-gastos'],
                    'icon' => 'fas fa-file-invoice-dollar',
                    'classes' => 'bg-light text-dark',
                ],
                [
                    'text' => 'Cuentas por Cobrar',
                    'icon_color' => 'green',  // Cargos de los pacientes
                    'route' => 'construccion.index',
                    'can' => ['ver-gastos'],
                    'icon' => 'fas fa-wallet',
                    'classes' => 'bg-light text-dark',
                ],
                [
                    'text' => 'Estadístico',
                    'icon_color' => 'gray',  // Cargos de los pacientes
                    'route' => 'construccion.index',
                    'can' => ['ver-gastos'],
                    'icon' => 'fas fa-chart-bar',
                    'classes' => 'bg-light text-dark',
                ],
                [
                    'text' => 'Cuadres',
                    'icon_color' => 'orange',  // Cargos de los pacientes
                    'route' => 'construccion.index',
                    'can' => ['ver-gastos'],
                    'icon' => 'fas fa-balance-scale',
                    'classes' => 'bg-light text-dark',
                ],
            ],
        ],
        [
            'text' => 'Parámetros',
            'icon' => 'fas fa-cogs',
            'classes' => 'bg-secondary text-white',
            'submenu' => [
                [
                    'text' => 'Terceros',
                    'icon' => 'fas fa-users',
                    'classes' => 'bg-cyan text-white',
                    'submenu' => [
                        [
                            'text' => 'Proveedores',
                            'icon_color' => 'cyan',
                            'route' => 'proveedores.index',
                            'can' => ['ver-proveedores'],
                            'icon' => 'fas fa-handshake',
                            'classes' => 'bg-light text-dark',
                        ],
                        [
                            'text' => 'Clientes',
                            'icon_color' => 'yellow',
                            'route' => 'clientes.index',
                            'can' => ['ver-clientes'],
                            'icon' => 'fas fa-user-tag',
                            'classes' => 'bg-light text-dark',
                        ],
                        [
                            'text' => 'Vendedores',
                            'icon_color' => 'red',
                            'route' => 'vendedores.index',
                            'can' => ['ver-vendedores'],
                            'icon' => 'fas fa-user-tie',
                            'classes' => 'bg-light text-dark',
                        ],
                        [
                            'text' => 'Empleados',
                            'icon_color' => 'green',
                            'route' => 'empleados.index',
                            'can' => ['ver-empleados'],
                            'icon' => 'fas fa-users-cog',
                            'classes' => 'bg-light text-dark',
                        ],

                        [
                            'text' => 'Pacientes',
                            'icon_color' => 'purple',
                            'route' => 'pacientes.index',
                            'can' => ['ver-pacientes'],
                            'icon' => 'fas fa-user-md',
                            'classes' => 'bg-light text-dark',
                        ],
                    ],
                ],
                [
                    'text' => 'Mini Bar',
                    'icon' => 'fas fa-boxes',
                    'classes' => 'bg-cyan text-white',
                    'submenu' => [

                        [
                            'text' => 'Inventario',
                            'icon_color' => 'cyan',  // Administración de Productos Vendidos
                            'route' => 'minibarinventario.index',
                            'can' => ['ver-minibar-inventario'],
                            'icon' => 'fas fa-archive',
                            'classes' => 'bg-light text-dark',
                        ],
                        [
                            'text' => 'Productos',
                            'icon_color' => 'cyan',  // Cargos de los pacientes
                            'route' => 'productos.index',
                            'can' => ['ver-productos'],
                            'icon' => 'fas fa-boxes',
                            'classes' => 'bg-light text-dark',
                        ],

                        [
                            'text' => 'ProductosComprados',
                            'icon_color' => 'green',  // Administración de Productos Vendidos
                            'route' => 'productoscomprados.index',
                            'can' => ['ver-productos-comprados'],
                            'icon' => 'fas fa-shopping-bag',
                            'classes' => 'bg-light text-dark',
                        ],

                        [
                            'text' => 'ProductosVendidos',
                            'icon_color' => 'cyan',  // Administración de Productos Vendidos
                            'route' => 'productosvendidos.index',
                            'can' => ['ver-productos-vendidos'],
                            'icon' => 'fas fa-shopping-cart',
                            'classes' => 'bg-light text-dark',
                        ],

                        [
                        'text' => 'Consumos',
                        'icon_color' => 'red',  // Módulo de consumos por habitación
                        'route' => 'consumos.index',  // ruta del controlador de consumos
                        'can' => ['ver-consumos'],     // permiso para ver consumos
                        'icon' => 'fas fa-utensils',   // ícono más relacionado con consumos
                        'classes' => 'bg-light text-dark',
                        ],

                        [
                            'text' => 'Servicios',
                            'icon_color' => 'yellow',  // Cargos de los pacientes
                            'route' => 'servicios.index',
                            'can' => ['ver-servicios'],
                            'icon' => 'fas fa-concierge-bell',
                            'classes' => 'bg-light text-dark',
                        ],
                        [
                            'text' => 'Categorias',
                            'icon_color' => 'red',  // Información de profesionales
                            'route' => 'construccion.index',
                            'can' => ['ver-gastos'],
                            'icon' => 'fas fa-tags',
                            'classes' => 'bg-light text-dark',
                        ],
                        [
                            'text' => 'Materiales',
                            'icon_color' => 'green',  // Pruebas clínicas
                            'route' => 'construccion.index',
                            'can' => ['ver-gastos'],
                            'icon' => 'fas fa-box-open',
                            'classes' => 'bg-light text-dark',
                        ],
                        [
                            'text' => 'Ensamblados',
                            'icon_color' => 'orange',  // CIE10
                            'route' => 'construccion.index',
                            'can' => ['ver-gastos'],
                            'icon' => 'fas fa-cubes',
                            'classes' => 'bg-light text-dark',
                        ],
                        [
                            'text' => 'Cambio de Precios',
                            'icon_color' => 'gray',  // Servicios ofrecidos
                            'route' => 'construccion.index',
                            'can' => ['ver-gastos'],
                            'icon' => 'fas fa-dollar-sign',
                            'classes' => 'bg-light text-dark',
                        ],
                        [
                            'text' => 'Sobreprecios',
                            'icon_color' => 'cyan',  // Configuración de géneros
                            'route' => 'construccion.index',
                            'can' => ['ver-gastos'],
                            'icon' => 'fas fa-receipt',
                            'classes' => 'bg-light text-dark',
                        ],
                    ],
                ],
                [
                    'text' => 'Otros',
                    'icon' => 'fas fa-th-list',
                    'classes' => 'bg-cyan text-white',
                    'submenu' => [
                        [
                            'text' => 'Gastos',
                            'icon_color' => 'cyan',  // Administración de examenes
                            'route' => 'gastos.index',
                            'can' => ['ver-gastos'],
                            'icon' => 'fas fa-credit-card',
                            'classes' => 'bg-light text-dark',
                        ],
                        [
                            'text' => 'Tipos de Documento',
                            'icon_color' => 'yellow',  // Administración de enfasis
                            'route' => 'construccion.index',
                            'can' => ['ver-gastos'],
                            'icon' => 'fas fa-file-alt',
                            'classes' => 'bg-light text-dark',
                        ],
                    ],
                ],

            ],

        ],
        [
            'text' => 'Seguridad',
            'icon' => 'fas fa-tools',
            'classes' => 'bg-secondary text-white',
            'submenu' => [
                [
                    'text' => 'Configuración',
                    'icon_color' => 'cyan',  // Ajustes generales
                    'route' => 'configuracion.index',
                    'can' => ['ver-configuracion'],
                    'icon' => 'fas fa-cog',
                    'classes' => 'bg-light text-dark',
                ],
                [
                    'text' => 'Usuarios',
                    'icon_color' => 'yellow',  // Administración de usuarios
                    'route' => 'users.index',
                    'can' => ['ver-usuarios'],
                    'icon' => 'fas fa-users',
                    'classes' => 'bg-light text-dark',
                ],
                [
                    'text' => 'Roles',
                    'icon_color' => 'red',  // Configuración de roles
                    'route' => 'roles.index',
                    'can' => ['ver-roles'],
                    'icon' => 'fas fa-user-cog',
                    'classes' => 'bg-light text-dark',
                ],
                [
                    'text' => 'Permisos',
                    'icon_color' => 'green',  // Permisos y accesos
                    'route' => 'permissions.index',
                    'can' => ['ver-permisos'],
                    'icon' => 'fas fa-user-shield',
                    'classes' => 'bg-light text-dark',
                ],
            ],
        ],
        [
            'text' => 'Cerrar Sesión',
            'icon_color' => 'white',
            'url' => '/logout',  // Cambia '/logout' por la URL real de tu ruta de logout si es diferente
            'icon' => 'fas fa-power-off',
            'classes' => 'bg-danger text-white',
        ]
    ],

    /*
    |--------------------------------------------------------------------------
    | Menu Filters
    |--------------------------------------------------------------------------
    |
    | Here we can modify the menu filters of the admin panel.
    |
    | For detailed instructions you can look the menu filters section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Menu-Configuration
    |
    */

    'filters' => [
        JeroenNoten\LaravelAdminLte\Menu\Filters\GateFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\HrefFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\SearchFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ActiveFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ClassesFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\LangFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\DataFilter::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Plugins Initialization
    |--------------------------------------------------------------------------
    |
    | Here we can modify the plugins used inside the admin panel.
    |
    | For detailed instructions you can look the plugins section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Plugins-Configuration
    |
    */

    'plugins' => [
        'jQuery' => [
            'active' => true,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false, // Es un enlace externo
                    'location' => '//code.jquery.com/jquery-3.6.0.min.js',
                    /*'location' => 'vendor/jquery/jquery.min.js',*/
                ],
            ],
        ],
        'Datatables' => [
            'active' => true,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    /*'location' => 'vendor/datatables/js/jquery.dataTables.min.js',*/
                    'location' => '//cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => false,
                    /*'location' => 'vendor/datatables/css/jquery.dataTables.min.css',*/
                    'location' => '//cdn.datatables.net/1.13.6/css/dataTables.bootstrap4.min.css',
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    /*'location' => 'vendor/datatables/js/dataTables.bootstrap4.min.js',*/
                    'location' => '//cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => false,
                    /*'location' => 'vendor/datatables/css/dataTables.bootstrap4.min.css',*/
                    'location' => '//cdn.datatables.net/1.13.6/css/dataTables.bootstrap4.min.css',
                ],
            ],
        ],
        'DatatablesPlugins' => [
            'active' => true,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'vendor/datatables-plugins/buttons/js/dataTables.buttons.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'vendor/datatables-plugins/buttons/js/buttons.bootstrap4.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'vendor/datatables-plugins/buttons/js/buttons.html5.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'vendor/datatables-plugins/buttons/js/buttons.print.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'vendor/datatables-plugins/jszip/jszip.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'vendor/datatables-plugins/pdfmake/pdfmake.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'vendor/datatables-plugins/pdfmake/vfs_fonts.js',
                ],
                [
                    'type' => 'css',
                    'asset' => true,
                    'location' => 'vendor/datatables-plugins/buttons/css/buttons.bootstrap4.min.css',
                ],
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'vendor/datatables-plugins/buttons/js/buttons.colVis.min.js',
                ],
            ],
        ],
        'Select2' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => true,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.css',
                ],
                [
                    'type' => 'css',
                    'asset' => true,
                    'location' => 'vendor/select2-bootstrap4-theme/select2-bootstrap4.min.css',
                ],
            ],
        ],
        'Chartjs' => [
            'active' => true,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'vendor/chart.js/Chart.bundle.min.js',
                    /*'location' => '//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.0/Chart.bundle.min.js',*/
                ],
            ],
        ],
        'Sweetalert2' => [
            'active' => true,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'vendor/sweetalert2/sweetalert2.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => true,
                    'location' => 'vendor/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css',
                ],
            ],
        ],
        'Pace' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/themes/blue/pace-theme-center-radar.min.css',
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/pace.min.js',
                ],
            ],
        ],
        'TempusDominusBs4' => [
            'active' => true,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'vendor/moment/moment.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'vendor/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js',
                    /*'location' => '//cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.39.0/js/tempusdominus-bootstrap-4.min.js',*/
                ],
                [
                    'type' => 'css',
                    'asset' => true,
                    'location' => 'vendor/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css',
                    /*'location' => '//cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.39.0/css/tempusdominus-bootstrap-4.min.css',*/
                ],
            ],
        ],
        'FontAwesome' => [
            'active' => true,
            'files' => [
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css',
                ],
            ],
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | IFrame
    |--------------------------------------------------------------------------
    |
    | Here we change the IFrame mode configuration. Note these changes will
    | only apply to the view that extends and enable the IFrame mode.
    |
    | For detailed instructions you can look the iframe mode section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/IFrame-Mode-Configuration
    |
    */

    'iframe' => [
        'default_tab' => [
            'url' => null,
            'title' => null,
        ],
        'buttons' => [
            'close' => true,
            'close_all' => true,
            'close_all_other' => true,
            'scroll_left' => true,
            'scroll_right' => true,
            'fullscreen' => true,
        ],
        'options' => [
            'loading_screen' => 1000,
            'auto_show_new_tab' => true,
            'use_navbar_items' => true,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Livewire
    |--------------------------------------------------------------------------
    |
    | Here we can enable the Livewire support.
    |
    | For detailed instructions you can look the livewire here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Other-Configuration
    |
    */

    'livewire' => false,
];
