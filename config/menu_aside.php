<?php
// Aside menu
return [

    'items' => [
        // Dashboard
        [
            'title' => 'Dashboard',
            'root' => true,
            'icon' => 'media/svg/icons/Design/Layers.svg', // or can be 'flaticon-home' or any flaticon-*
            'page' => '/',
            'new-tab' => false,
        ],
        // Custom
        [
            'section' => 'Client Management',
        ],
        [
            'title' => 'Clients',
            'icon' => 'media/svg/icons/Layout/Layout-4-blocks.svg',
            'bullet' => 'line',
            'root' => true,
            'submenu' => [
                [
                    'title' => 'List',
                    'page' => 'clients',
                ],
                [
                    'title' => 'Add ',
                    'page' => 'clients/create',
                ],
            ]
        ],

        // Custom
        [
            'section' => 'User Management',
        ],
        [
            'title' => 'Users',
            'icon' => 'media/svg/icons/Layout/Layout-4-blocks.svg',
            'bullet' => 'line',
            'root' => true,
            'submenu' => [
                [
                    'title' => 'List',
                    'page' => 'users',
                ],
                [
                    'title' => 'Add ',
                    'page' => 'users/create',
                ],
            ]
        ],
        [
            'section' => 'Catalogue',
        ],
        [
            'title' => 'Brands',
            'icon' => 'media/svg/icons/Layout/Layout-4-blocks.svg',
            'bullet' => 'line',
            'root' => true,
            'submenu' => [
                [
                    'title' => 'List',
                    'page' => 'brands',
                ],
                [
                    'title' => 'Add ',
                    'page' => 'brands/create',
                ],
            ]
        ],
        [
            'title' => 'Categories',
            'icon' => 'media/svg/icons/Layout/Layout-4-blocks.svg',
            'bullet' => 'line',
            'root' => true,
            'submenu' => [
                [
                    'title' => 'List',
                    'page' => 'categories',
                ],
                [
                    'title' => 'Add ',
                    'page' => 'categories/create',
                ],
            ]
        ],
        [
            'title' => 'Attributes',
            'icon' => 'media/svg/icons/Layout/Layout-4-blocks.svg',
            'bullet' => 'line',
            'root' => true,
            'submenu' => [
                [
                    'title' => 'List',
                    'page' => 'attributes',
                ],
                [
                    'title' => 'Add ',
                    'page' => 'attributes/create',
                ],
            ]
        ],
        [
            'title' => 'Products',
            'icon' => 'media/svg/icons/Layout/Layout-4-blocks.svg',
            'bullet' => 'line',
            'root' => true,
            'submenu' => [
                [
                    'title' => 'List',
                    'page' => 'products',
                ],
                [
                    'title' => 'Add ',
                    'page' => 'products/create',
                ],
            ]
        ],
        [
            'title' => 'Testimonials',
            'icon' => 'media/svg/icons/Layout/Layout-4-blocks.svg',
            'bullet' => 'line',
            'root' => true,
            'submenu' => [
                [
                    'title' => 'List',
                    'page' => 'testimonials',
                ],
                [
                    'title' => 'Add ',
                    'page' => 'testimonials/create',
                ],
            ]
        ],
        [
            'title' => 'News',
            'icon' => 'media/svg/icons/Layout/Layout-4-blocks.svg',
            'bullet' => 'line',
            'root' => true,
            'submenu' => [
                [
                    'title' => 'List',
                    'page' => 'news',
                ],
                [
                    'title' => 'Add ',
                    'page' => 'news/create',
                ],

            ]
        ],
        [
            'title' => 'News Letter',
            'icon' => 'media/svg/icons/Layout/Layout-4-blocks.svg',
            'bullet' => 'line',
            'root' => true,
            'submenu' => [
                [
                    'title' => 'List',
                    'page' => 'newsLetters',
                ],
                [
                    'title' => 'Add ',
                    'page' => 'newsLetters/create',
                ],

            ]
        ],
        [
            'title' => 'SEO',
            'icon' => 'media/svg/icons/Layout/Layout-4-blocks.svg',
            'bullet' => 'line',
            'root' => true,
            'submenu' => [
                [
                    'title' => 'List',
                    'page' => 'seo',
                ],
                [
                    'title' => 'Add ',
                    'page' => 'seo/create',
                ],
            ]
        ],
        [
            'title' => 'Menu',
            'icon' => 'media/svg/icons/Layout/Layout-4-blocks.svg',
            'bullet' => 'line',
            'root' => true,
            'submenu' => [
                [
                    'title' => 'List',
                    'page' => 'menus',
                ],
                [
                    'title' => 'Add ',
                    'page' => 'menus/create',
                ],
            ]
        ],
        [
            'title' => 'Coupons',
            'icon' => 'media/svg/icons/Layout/Layout-4-blocks.svg',
            'bullet' => 'line',
            'root' => true,
            'submenu' => [
                [
                    'title' => 'List',
                    'page' => 'coupons',
                ],
                [
                    'title' => 'Add ',
                    'page' => 'coupons/create',
                ],
            ]
        ],
        [
            'title' => 'Country',
            'icon' => 'media/svg/icons/Layout/Layout-4-blocks.svg',
            'bullet' => 'line',
            'root' => true,
            'submenu' => [
                [
                    'title' => 'List',
                    'page' => 'countries',
                ],
                [
                    'title' => 'Add ',
                    'page' => 'countries/create',
                ],
            ]
        ],
        [
            'title' => 'State',
            'icon' => 'media/svg/icons/Layout/Layout-4-blocks.svg',
            'bullet' => 'line',
            'root' => true,
            'submenu' => [
                [
                    'title' => 'List',
                    'page' => 'states',
                ],
                [
                    'title' => 'Add ',
                    'page' => 'states/create',
                ],
            ]
        ],
        [
            'title' => 'City',
            'icon' => 'media/svg/icons/Layout/Layout-4-blocks.svg',
            'bullet' => 'line',
            'root' => true,
            'submenu' => [
                [
                    'title' => 'List',
                    'page' => 'cities',
                ],
                [
                    'title' => 'Add ',
                    'page' => 'cities/create',
                ],
            ]
        ],
        [
            'title' => 'Tax',
            'icon' => 'media/svg/icons/Layout/Layout-4-blocks.svg',
            'bullet' => 'line',
            'root' => true,
            'submenu' => [
                [
                    'title' => 'List',
                    'page' => 'tax',
                ],
                [
                    'title' => 'Add ',
                    'page' => 'tax/create',
                ],
            ]
        ],
        [
            'title' => 'Address',
            'icon' => 'media/svg/icons/Layout/Layout-4-blocks.svg',
            'bullet' => 'line',
            'root' => true,
            'submenu' => [
                [
                    'title' => 'List',
                    'page' => 'addresses',
                ],
                [
                    'title' => 'Add ',
                    'page' => 'addresses/create',
                ],
            ]
        ],
        [
            'title' => 'Currency',
            'icon' => 'media/svg/icons/Layout/Layout-4-blocks.svg',
            'bullet' => 'line',
            'root' => true,
            'submenu' => [
                [
                    'title' => 'List',
                    'page' => 'currency',
                ],
                [
                    'title' => 'Add ',
                    'page' => 'currency/create',
                ],
            ]
        ],
        [
            'title' => 'Timezone',
            'icon' => 'media/svg/icons/Layout/Layout-4-blocks.svg',
            'bullet' => 'line',
            'root' => true,
            'submenu' => [
                [
                    'title' => 'List',
                    'page' => 'timezone',
                ],
                [
                    'title' => 'Add ',
                    'page' => 'timezone/create',
                ],
            ]
        ],
        [
            'title' => 'Language',
            'icon' => 'media/svg/icons/Layout/Layout-4-blocks.svg',
            'bullet' => 'line',
            'root' => true,
            'submenu' => [
                [
                    'title' => 'List',
                    'page' => 'languages',
                ],
                [
                    'title' => 'Add ',
                    'page' => 'languages/create',
                ],
            ]
        ],

        // [
        //     'title' => 'Message',
        //     'icon' => 'media/svg/icons/Layout/Layout-4-blocks.svg',
        //     'bullet' => 'line',
        //     'root' => true,
        //     'submenu' => [
        //         [
        //             'title' => 'List',
        //             'page' => 'messages',
        //         ],
        //         [
        //             'title' => 'Add ',
        //             'page' => 'messages/create',
        //         ],
        //     ]
        // ],
        [
            'title' => 'User Message',
            'icon' => 'media/svg/icons/Layout/Layout-4-blocks.svg',
            'bullet' => 'line',
            'root' => true,
            'submenu' => [
                [
                    'title' => 'List',
                    'page' => 'userMessages',
                ],
                [
                    'title' => 'Add ',
                    'page' => 'userMessages/create',
                ],
            ]
        ],
        [
            'title' => 'Todo',
            'icon' => 'media/svg/icons/Layout/Layout-4-blocks.svg',
            'bullet' => 'line',
            'root' => true,
            'submenu' => [
                [
                    'title' => 'List',
                    'page' => 'todos',
                ],
                [
                    'title' => 'Add ',
                    'page' => 'todos/create',
                ],
            ]
        ],
        [
            'title' => 'Email Template',
            'icon' => 'media/svg/icons/Layout/Layout-4-blocks.svg',
            'bullet' => 'line',
            'root' => true,
            'submenu' => [
                [
                    'title' => 'List',
                    'page' => 'email_templates',
                ],
                [
                    'title' => 'Add ',
                    'page' => 'email_templates/create',
                ],
            ]
        ],
        [
            'title' => 'Banner',
            'icon' => 'media/svg/icons/Layout/Layout-4-blocks.svg',
            'bullet' => 'line',
            'root' => true,
            'submenu' => [
                [
                    'title' => 'List',
                    'page' => 'banners',
                ],
                [
                    'title' => 'Add ',
                    'page' => 'banners/create',
                ],
            ]
        ],
        [
            'title' => 'Role',
            'icon' => 'media/svg/icons/Layout/Layout-4-blocks.svg',
            'bullet' => 'line',
            'root' => true,
            'submenu' => [
                [
                    'title' => 'List',
                    'page' => 'roles',
                ],
                [
                    'title' => 'Add ',
                    'page' => 'roles/create',
                ],
            ]
        ],
        [
            'title' => 'User Role',
            'icon' => 'media/svg/icons/Layout/Layout-4-blocks.svg',
            'bullet' => 'line',
            'root' => true,
            'submenu' => [
                [
                    'title' => 'List',
                    'page' => 'user_roles',
                ],
                [
                    'title' => 'Add ',
                    'page' => 'user_roles/create',
                ],
            ]
        ],
        [
            'title' => 'Permission',
            'icon' => 'media/svg/icons/Layout/Layout-4-blocks.svg',
            'bullet' => 'line',
            'root' => true,
            'submenu' => [
                [
                    'title' => 'List',
                    'page' => 'permissions',
                ],
                [
                    'title' => 'Add ',
                    'page' => 'permissions/create',
                ],
            ]
        ],
        [
            'title' => 'Role Permission',
            'icon' => 'media/svg/icons/Layout/Layout-4-blocks.svg',
            'bullet' => 'line',
            'root' => true,
            'submenu' => [
                [
                    'title' => 'List',
                    'page' => 'role_permissions',
                ],
                [
                    'title' => 'Add ',
                    'page' => 'role_permissions/create',
                ],
            ]
        ],
    ]

];
