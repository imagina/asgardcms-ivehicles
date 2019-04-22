<?php

return [
    'name' => 'Ivehicles',

    'imagesize' => ['width' => 1024, 'height' => 768],
    'mediumthumbsize' => ['width' => 400, 'height' => 300],
    'smallthumbsize' => ['width' => 100, 'height' => 80],


    /*
            |--------------------------------------------------------------------------
        | Load additional view namespaces for a module
    |--------------------------------------------------------------------------
        | You can specify place from which you would like to use module views.
        | You can use any combination, but generally it's advisable to add only one,
        | extra view namespace.
        | By default every extra namespace will be set to false.
        */
    'useViewNamespaces' => [
        // Read module views from /Themes/<backend-theme-name>/views/modules/<module-name>
        'backend-theme' => false,
        // Read module views from /Themes/<frontend-theme-name>/views/modules/<module-name>
        'frontend-theme' => false,
        // Read module views from /resources/views/asgard/<module-name>
        'resources' => true,
    ],
];
