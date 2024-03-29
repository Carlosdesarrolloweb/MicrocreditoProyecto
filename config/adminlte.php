<?php

use Symfony\Component\HttpKernel\Profiler\Profile;

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

    'title' => 'AdminLTE 3',
    'title_prefix' => '',
    'title_postfix' => '',

    /*
    |--------------------------------------------------------------------------
    | Favicon
    |--------------------------------------------------------------------------
    |
    | Here you can activate the favicon.
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

    'logo' => '<b></b>MicrocreditosMary',
    'logo_img' => 'vendor/adminlte/dist/img/AdminLTELogo.png',
    'logo_img_class' => 'brand-image img-circle elevation-3',
    'logo_img_xl' => null,
    'logo_img_xl_class' => 'brand-image-xs',
    'logo_img_alt' => 'Logo',

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
            'path' => 'vendor/adminlte/dist/img/AdminLTELogo.png',
            'alt' => 'Auth Logo',
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
            'path' => 'vendor/adminlte/dist/img/AdminLTELogo.png',
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
    | Here you can activate and change the user menu.
    |
    | For detailed instructions you can look the user menu section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */


    'usermenu_enabled' => false,
    'usermenu_header' => true,
    'usermenu_header_class' => 'bg-danger justify-content-center',
    'usermenu_image' => true,
    'usermenu_desc' => false,
    'usermenu_profile_url' => true,

    /*
    |--------------------------------------------------------------------------
    | Layout
    |--------------------------------------------------------------------------
    |
    | Here we change the layout of your admin panel.
    |
    | For detailed instructions you can look the layout section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'layout_topnav' => null,
    'layout_boxed' => null,
    'layout_fixed_sidebar' => true,
    'layout_fixed_navbar' => true,
    'layout_fixed_footer' => null,
    'layout_dark_mode' => null,

    /*
    |--------------------------------------------------------------------------
    | Authentication Views Classes
    |--------------------------------------------------------------------------
    |
    | Here you can change the look and behavior of the authentication views.
    |
    | For detailed instructions you can look the auth classes section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'classes_auth_card' => 'card-outline card-warning',
    'classes_auth_header' => '',
    'classes_auth_body' => '',
    'classes_auth_footer' => '',
    'classes_auth_icon' => '',
    'classes_auth_btn' => 'btn-flat btn-primary',

    /*
    |--------------------------------------------------------------------------
    | Admin Panel Classes
    |--------------------------------------------------------------------------
    |
    | Here you can change the look and behavior of the admin panel.
    |
    | For detailed instructions you can look the admin panel classes here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'classes_body' => '',
    'classes_brand' => 'bg-red',
    'classes_brand_text' => '',
    'classes_content_wrapper' => '',
    'classes_content_header' => '',
    'classes_content' => '',
    'classes_sidebar' => 'sidebar-dark-red elevation-4',
    'classes_sidebar_nav' => '',
    'classes_topnav' => 'navbar-red navbar-light',
    'classes_topnav_nav' => 'navbar-expand',
    'classes_topnav_container' => 'container',

    /*
    |--------------------------------------------------------------------------
    | Sidebar
    |--------------------------------------------------------------------------
    |
    | Here we can modify the sidebar of the admin panel.
    |
    | For detailed instructions you can look the sidebar section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'sidebar_mini' => 'lg',
    'sidebar_collapse' => true,
    'sidebar_collapse_auto_size' => false,
    'sidebar_collapse_remember' => false,
    'sidebar_collapse_remember_no_transition' => true,
    'sidebar_scrollbar_theme' => 'os-theme-light',
    'sidebar_scrollbar_auto_hide' => 'l',
    'sidebar_nav_accordion' => true,
    'sidebar_nav_animation_speed' => 300,

    /*
    |--------------------------------------------------------------------------
    | Control Sidebar (Right Sidebar)
    |--------------------------------------------------------------------------
    |
    | Here we can modify the right sidebar aka control sidebar of the admin panel.
    |
    | For detailed instructions you can look the right sidebar section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'right_sidebar' => false,
    'right_sidebar_icon' => 'fas fa-cogs',
    'right_sidebar_theme' => 'dark',
    'right_sidebar_slide' => true,
    'right_sidebar_push' => true,
    'right_sidebar_scrollbar_theme' => 'os-theme-light',
    'right_sidebar_scrollbar_auto_hide' => 'l',

    /*
    |--------------------------------------------------------------------------
    | URLs
    |--------------------------------------------------------------------------
    |
    | Here we can modify the url settings of the admin panel.
    |
    | For detailed instructions you can look the urls section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'use_route_url' => false,
    'dashboard_url' => 'dashboard',
    'logout_url' => 'logout',
    'login_url' => 'login',
    'register_url' => 'register',
    'password_reset_url' => 'password/reset',
    'password_email_url' => 'password/email',
     'profile_url' => 'user/profile',

    /*
    |--------------------------------------------------------------------------
    | Laravel Mix
    |--------------------------------------------------------------------------
    |
    | Here we can enable the Laravel Mix option for the admin panel.
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
    | Here we can modify the sidebar/top navigation of the admin panel.
    |
    | For detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Menu-Configuration
    |
    */

    'menu' => [
        // Navbar items:
        [
            'type'         => 'navbar-search',
            'text'         => 'search',
            'topnav_right' => true,
        ],
        [
            'type'         => 'fullscreen-widget',
            'topnav_right' => false,
        ],

        // Sidebar items:
        [
            'type' => 'sidebar-menu-search',
            'text' => 'search',
        ],
        [
            'text' => 'blog',
            'url'  => 'admin/blog',
            'can'  => 'manage-blog',
        ],


        [
            'text'        => 'INICIO',
            'route'  => 'dashboard',
            'icon'        => 'fas fa-home fa-lg',
            'label_color' => 'success',
            'icon_color' => 'black',
        ],
        [
            'text'    => 'PERFIL',
            'icon'    => 'fas fa-user-circle fa-lg',
            'icon_color' => 'red',
            'submenu' => [
                [
                    'text' => 'Ver Perfil',
                    'route'  => 'profile.show',
                    'icon'    => 'fas fa-eye',
                    'icon_color' => 'red',
                ],
            ],

        ],

        ['header' => 'ADMINISTRADOR'],
     /*    [
            'text' => 'profile',
            'url'  => 'admin/settings',
            'icon' => 'fas fa-fw fa-user',
        ], */
 /*        [
            'text' => 'change_password',
            'url'  => 'admin/settings',
            'icon' => 'fas fa-fw fa-lock',
        ], */
        [
            'text'    => 'Usuarios',
            'icon'    => 'fas fa-user-shield fa-lg',
            'icon_color' => 'red',
            'submenu' => [
                // [
                //     'text' => 'Consultar Usuarios',
                //     'url'  => '#',
                //     'icon'    => 'fa fa-search',
                //     'icon_color' => 'red',
                // ],

                [
                    'text' => 'Crear Usuarios',
                    'route'  => 'crearusuario',
                    'icon'    => 'fa fa-user-plus',
                    'icon_color' => 'red',
                    /* 'can' => 'eliminar:usuario', */
                ],
                [
                    'text' => 'Ver Usuarios',
                    'route'  => 'usersv',
                    'icon'    => 'fas fa-search',
                    'icon_color' => 'red',

                ],
                [
                    'text' => 'Ver Permisos',
                    'route'  => 'permisos.index',
                    'icon'    => 'fas fa-eye',
                    'icon_color' => 'red',

                ],
                [
                    'text' => 'Ver Roles',
                    'route'  => 'roles.index',
                    'icon'    => 'fas fa-user',
                    'icon_color' => 'red',

                ],
/*                 [
                    'text' => 'Asignar Roles',
                    'url'  => '#',
                    'icon'    => 'fas fa-user-lock',
                    'icon_color' => 'red',

                ], */
            ],

        ],
/*         [
            'text'    => ' Reportes',
            'icon'    => 'fa fa-file',
            'icon_color' => 'red',
            'submenu' => [
                [
                    'text' => ' Ingresos Diarios',
                    'url'  => '#',
                    'icon'    => 'fa fa-file',
                    'icon_color' => 'red',
                ],

                [
                    'text' => 'Ingresos Mes',
                    'url'  => '#',
                    'icon'    => 'fa fa-file',
                    'icon_color' => 'red',
                ],
                [
                    'text' => 'Movimiento Usuarios',
                    'url'  => '#',
                    'icon'    => 'fas fa-diagnoses',
                    'icon_color' => 'red',
                ],
            ],

        ], */
   /*      [
            'text'    => 'Ingresos',
            'icon'    => 'fas fa-money-bill',
            'icon_color' => 'red',
            'submenu' => [
                [
                    'text' => 'Ganancias',
                    'url'  => '#',
                    'icon_color' => 'red',
                ],


            ],

        ], */

        ['header' => 'OPCIONES'],
        [
            'text'    => 'Prestamos',
            'icon'    => 'fas fa-money-bill fa-lg',
            'icon_color' => 'red',
            'submenu' => [
                [
                    'text' => 'Realizar Prestamo',
                    'route'  => 'prestamos.create',
                    'icon'    => 'fas fa-handshake',
                    'icon_color' => 'red',
                ],
/*                 [
                    'text' => 'Registrar Pagos',
                    'route'  => 'pagos.create',
                    'icon'    => 'fas fa-money-bill-wave',
                    'icon_color' => 'red',
                ],
                [
                    'text' => 'Pagos Realizados ',
                    'route'  => 'pagos.index',
                    'icon'    => 'fas fa-money-check-alt',
                    'icon_color' => 'red',
                ], */
            /*     [
                    'text' => 'Calendario ',
                    'route'  => 'calendarioPagos',
                    'icon'    => 'fas fa-money-check-alt',
                    'icon_color' => 'red',
                ], */
                [
                    'text' => ' Prestamos Realizados',
                    'route'  => 'prestamos.index',
                    'icon'    => 'fas fa-file-invoice-dollar',
                    'icon_color' => 'red',
                ],

     /*            [
                    'text' => 'Registrar Garantia',
                    'route'  => 'garantias.create',
                    'icon'    => 'fas fa-file-alt',
                    'icon_color' => 'red',
                ],
                [
                    'text' => 'Consultar Garantias',
                    'route'  => 'garantias.index',
                    'icon'    => 'fas fa-search',
                    'icon_color' => 'red',
                ], */
            ],

        ],
        [
            'text'    => 'Pagos',
            'icon'    => 'fas fa-dollar-sign fa-2x',
            'icon_color' => 'red',
            'submenu' => [
                [
                    'text' => 'Registrar Pagos',
                    'route'  => 'pagos.create',
                    'icon'    => 'fas fa-money-bill-wave',
                    'icon_color' => 'red',
                ],
                [
                    'text' => 'Pagos Realizados ',
                    'route'  => 'pagos.index',
                    'icon'    => 'fas fa-money-check-alt',
                    'icon_color' => 'red',
                ],

            ],

        ],
        [
            'text'    => 'Clientes',
            'icon'    => 'fa fa-users fa-lg',
            'icon_color' => 'red',
            'submenu' => [
                [
                    'text' => 'Consultar Clientes',
                    'route'  => 'clientesv',
                    'icon'    => 'fas fa-search',
                    'icon_color' => 'red',
                ],
                [
                    'text' => 'Crear Clientes',
                    'route'  => 'clientes.show',
                    'icon'    => 'fa fa-user-plus',
                    'icon_color' => 'red',
                ],
            ],

        ],

        [
            'text'    => 'Garantias',
            'icon'    => 'fas fa-shield-alt fa-lg',
            'icon_color' => 'red',
            'submenu' => [
                [
                    'text' => 'Registrar Garantia',
                    'route'  => 'garantias.create',
                    'icon'    => 'fas fa-file-alt',
                    'icon_color' => 'red',
                ],
                [
                    'text' => 'Consultar Garantias',
                    'route'  => 'garantias.index',
                    'icon'    => 'fas fa-search',
                    'icon_color' => 'red',
                ],

            ],

        ],
        [
            'text'    => 'Procesos',
            'icon'    => 'fas fa-cogs fa-lg',
            'icon_color' => 'red',
            'submenu' => [
                [
                    'text' => 'Agregar Interes',
                    'route'  => 'interests.create',
                    'icon'    => 'fa fa-percent',
                    'icon_color' => 'red',
                ],
                [
                    'text' => 'Agregar Modos de Pago',
                    'route'  => 'modosPago.create',
                    'icon'    => 'fas fa-credit-card',
                    'icon_color' => 'red',
                ],
                 [
                    'text' => 'Ver Modos de Pago',
                    'route'  => 'modos_pago.index',
                    'icon'    => 'fas fa-eye',
                    'icon_color' => 'red',
                ],
                [
                    'text' => 'Crear Zona',
                    'route'  => 'zona.create',
                    'icon'    => 'fas fa-map-marker-alt',
                    'icon_color' => 'red',
                ],
                [
                    'text' => 'Ver Zonas',
                    'route'  => 'zonas.index',
                    'icon'    => 'fas fa-map',
                    'icon_color' => 'red',
                ],
                [
                    'text' => 'Asignar Ciudad',
                    'route'  => 'ciudades.create',
                    'icon'    => 'fas fa-city',
                    'icon_color' => 'red',
                ],

            ],

        ],
        [
            'text'    => 'Ganancias',
            'icon'    => 'fa fa-users fa-lg',
            'icon_color' => 'red',
            'submenu' => [
                [
                    'text' => 'Ingreso Diario',
                    'route'  => 'ganancia.create',
                    'icon'    => 'fas fa-search',
                    'icon_color' => 'red',
                ],
                [
                    'text' => 'Ingreso Mensual',
                    'route'  => 'ganancia.ganancias-mensuales',
                    'icon'    => 'fa fa-user-plus',
                    'icon_color' => 'red',
                ],
            ],
        ],
        [
            'text'    => 'Reportes',
            'icon'    => 'fas fa-file fa-lg',
            'icon_color' => 'red',
            'submenu' => [
                [
                    'text' => 'Clientes Creados ',
                    'route'  => 'reportes.clientescreados',
                    'icon'    => 'fa fa-user-plus',
                    'icon_color' => 'red',
                ],
                [
                    'text' => 'Historial Prestamos ',
                    'route'  => 'reportes.historialprestamos',
                    'icon'    => 'fas fa-history',
                    'icon_color' => 'red',
                ],
                [
                    'text' => 'Historial Garantias ',
                    'route'  => 'reportes.historialgarantias',
                    'icon'    => 'fas fa-file-alt',
                    'icon_color' => 'red',
                ],
                [
                    'text' => 'Movimientos Usuarios ',
                    'route'  => 'reportes.movimientosbitacora',
                    'icon'    => 'fas fa-users',
                    'icon_color' => 'red',
                ],
                [
                    'text' => 'Reporte Pagos ',
                    'route'  => 'reportes.historialpagos',
                    'icon'    => 'fas fa-file-invoice-dollar',
                    'icon_color' => 'red',
                ],
                [
                    'text' => 'Reporte Ganancias ',
                    'route'  => 'reportes.ganancias',
                    'icon'    => 'fas fa-chart-line',
                    'icon_color' => 'red',
                ],
                [
                    'text' => 'Graficos ',
                    'route'  => 'reportes.powerbi',
                    'icon'    => 'fas fa-chart-bar',
                    'icon_color' => 'red',
                ],
            ],

        ],


    /*     ['header' => 'labels'],
        [
            'text'       => 'important',
            'icon_color' => 'red',
            'url'        => '#',
        ],
        [
            'text'       => 'warning',
            'icon_color' => 'yellow',
            'url'        => '#',
        ],
        [
            'text'       => 'information',
            'icon_color' => 'cyan',
            'url'        => '#',
        ], */
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
        'Datatables' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css',
                ],
            ],
        ],
        'Select2' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.css',
                ],
            ],
        ],
        'Chartjs' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.0/Chart.bundle.min.js',
                ],
            ],
        ],
        'Sweetalert2' => [
            'active' => true,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => '/public/vendor/sweetalert2/sweetalert2.all.min.js',
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
