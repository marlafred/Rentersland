<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Title
    |--------------------------------------------------------------------------
    |
    | The default title of your admin panel, this goes into the title tag
    | of your page. You can override it per page with the title section.
    | You can optionally also specify a title prefix and/or postfix.
    |
    */

    'title' => 'Renters Land',

    'title_prefix' => '',

    'title_postfix' => '',

    /*
    |--------------------------------------------------------------------------
    | Logo
    |--------------------------------------------------------------------------
    |
    | This logo is displayed at the upper left corner of your admin panel.
    | You can use basic HTML here if you want. The logo has also a mini
    | variant, used for the mini side bar. Make it 3 letters or so
    |
    */

    'logo' => '<b>Renters</b>Land',

    'logo_mini' => '<b>Renters</b>',

    /*
    |--------------------------------------------------------------------------
    | Skin Color
    |--------------------------------------------------------------------------
    |
    | Choose a skin color for your admin panel. The available skin colors:
    | blue, black, purple, yellow, red, and green. Each skin also has a
    | ligth variant: blue-light, purple-light, purple-light, etc.
    |
    */

    'skin' => 'blue',

    /*
    |--------------------------------------------------------------------------
    | Layout
    |--------------------------------------------------------------------------
    |
    | Choose a layout for your admin panel. The available layout options:
    | null, 'boxed', 'fixed', 'top-nav'. null is the default, top-nav
    | removes the sidebar and places your menu in the top navbar
    |
    */

    'layout' => null,

    /*
    |--------------------------------------------------------------------------
    | Collapse Sidebar
    |--------------------------------------------------------------------------
    |
    | Here we choose and option to be able to start with a collapsed side
    | bar. To adjust your sidebar layout simply set this  either true
    | this is compatible with layouts except top-nav layout option
    |
    */

    'collapse_sidebar' => true,

    /*
    |--------------------------------------------------------------------------
    | URLs
    |--------------------------------------------------------------------------
    |
    | Register here your dashboard, logout, login and register URLs. The
    | logout URL automatically sends a POST request in Laravel 5.3 or higher.
    | You can set the request to a GET or POST with logout_method.
    | Set register_url to null if you don't want a register link.
    |
    */

    'dashboard_url' => 'admin',

    'logout_url' => 'admin/logout',

    'logout_method' => null,

    'login_url' => 'admin/login',

    'register_url' => '',

    /*
    |--------------------------------------------------------------------------
    | Menu Items
    |--------------------------------------------------------------------------
    |
    | Specify your menu items to display in the left sidebar. Each menu item
    | should have a text and and a URL. You can also specify an icon from
    | Font Awesome. A string instead of an array represents a header in sidebar
    | layout. The 'can' is a filter on Laravel's built in Gate functionality.
    |
    */

    'menu' => [
        'HOME',
        [
            'text'    => 'Visit Site',
            'url'  => 'home',
            'icon'    => 'globe',
        ],
        
        'DASHBOARD',
        [
            'text'    => 'Dashboard',
            'url'  => 'admin',
            'icon'    => 'dashboard',
        ],
       
        'Home',
        [
            'text'    => 'Home',
            'icon'    => 'home',
            'url'  => '',
            'submenu' => [
                [
                    'text' => 'Home Bubbles',
                    'url'  => 'admin/bubbles',
                    'icon'    => '',
                ],
                /*[
                    'text' => 'Slider Management',
                    'url'  => 'admin/slider',
                    'icon'    => '',
                ],
                [
                    'text' => 'How It Works',
                    'url'  => 'admin/how-it-works',
                    'icon'    => '',
                ],
                [
                    'text' => 'About Us',
                    'url'  => 'admin/about-us',
                    'icon'    => '',
                ],*/
            ],
        ],
        
        'Settings',
        [
            'text'    => 'Settings',
            'icon'    => 'cog',
            'submenu' => [
                [
                    'text' => 'Genral Settings',
                    'url'  => 'admin/settings',
                    'icon'    => '',
                ],
                [
                    'text' => 'Main Navigation',
                    'url'  => "admin/states",
                    'icon'    => '',
                ],
                [
                    'text' => 'Navigation Towns',
                    'url'  => "admin/states",
                    'icon'    => '',
                ],
            ],
        ],
        
        'Static Pages',
        [
            'text'    => 'Static Pages',
            'icon'    => 'files-o',
            'submenu' => [
                [
                    'text' => 'Pages List',
                    'url'  => 'admin/pages',
                    'icon'    => '',
                ],
                [
                    'text' => 'Add New Page',
                    'url'  => 'admin/add-pages',
                    'icon'    => '',
                ],
                
            ],
        ],
        
       'EMAILS',
        [
            'text'    => 'EMAIL SETTING',
            'icon'    => 'inbox',
            'url'  => 'admin/email-templates',
            'submenu' => [
                [
                    'text' => 'Emails',
                    'url'  => 'admin/email/register',
                    'icon'    => '',
                ],
                [
                    'text' => 'New Account',
                    'url'  => 'admin/email/register',
                    'icon'    => '',
                ],
                [
                    'text' => 'New Adds Listing',
                    'url'  => 'admin/email/listing',
                    'icon'    => '',
                ],
                [
                    'text' => 'New Plan Request',
                    'url'  => 'admin/email/plan',
                    'icon'    => '',
                ],
            ],
        ],
        
        'NEWS LETTER',
        [
            'text'    => 'News Letters',
            'icon'    => 'envelope',
            'url'  => 'admin/newsletters',
            'submenu' => [
                [
                    'text' => 'News Letters',
                    'url'  => 'admin/newsletters',
                    'icon'    => '',
                ],
            ],
        ],
        
        'ADDS LISTINGS',
        [
            'text'    => 'Listings',
            'icon'    => 'newspaper-o',
            'submenu' => [
                [
                    'text' => 'Listings',
                    'url'  => 'admin/listings',
                    'icon'    => '',
                ],
                [
                    'text' => 'My Listings',
                    'url'  => 'admin/mylistings',
                    'icon'    => '',
                ],
                [
                    'text' => 'Create Listings',
                    'url'  => 'admin/createlistings',
                    'icon'    => '',
                ],
                
            ],
        ],
        'TOUR REQUESTS',
        [
            'text' => 'Applicants',
            'icon' => 'tripadvisor',
            'submenu' => [
                [
                    'text' => 'Applicants',
                    'url'  => 'admin/applicants',
                    'icon'    => '',
                ],
                [
                    'text' => 'My Listings',
                    'url'  => 'admin/requests',
                    'icon'    => '',
                ],
               
                
            ],
        ],
        'ACCOUNTS',
        [
            'text'    => 'Accounts',
            'icon'    => 'user',
            'submenu' => [
                [
                    'text' => 'Landlords',
                    'url'  => 'admin/accounts',
                    'icon'    => 'user',
                ],
                [
                    'text' => 'Tenants',
                    'url'  => 'admin/tenants',
                    'icon'    => 'building-o',
                ],
                
            ],
        ],
        'APPLICATIONS',
        [
            'text' => 'Tenant Applications',
            'icon' => 'file-code-o',
            'url'  => 'admin/tenant-application',
        ],
        
    ],

    /*
    |--------------------------------------------------------------------------
    | Menu Filters
    |--------------------------------------------------------------------------
    |
    | Choose what filters you want to include for rendering the menu.
    | You can add your own filters to this array after you've created them.
    | You can comment out the GateFilter if you don't want to use Laravel's
    | built in Gate functionality
    |
    */

    'filters' => [
        JeroenNoten\LaravelAdminLte\Menu\Filters\HrefFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ActiveFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\SubmenuFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ClassesFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\GateFilter::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Plugins Initialization
    |--------------------------------------------------------------------------
    |
    | Choose which JavaScript plugins should be included. At this moment,
    | only DataTables is supported as a plugin. Set the value to true
    | to include the JavaScript file from a CDN via a script tag.
    |
    */

    'plugins' => [
        'datatables' => true,
        'select2'    => true,
    ],
];
