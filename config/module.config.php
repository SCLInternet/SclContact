<?php

return array(
    'scl_contact' => array(
        /*
         * The name of the service or class to be used to find and list countries.
         */
        'country_manager' => 'SclContact\Country\CountryManager',

        /*
         * The name or service of the Country class to use.
         */
        'country_class' => 'SclContact\Country',

        /*
         * Should the country manager return shared instances of countries.
         */
        'shared_countries' => true,

        /*
         * The identifier of the default country.
         */
        'default_country' => 'gb',

        /*
         * The config file for the default country manager.
         */
        'country_file_path' => __DIR__ . '/countries.config.php',
    ),

    'view_manager' => array(
        'template_path_stack' => array(
            'SclContact' => __DIR__ . '/../view',
        ),
    ),
);
