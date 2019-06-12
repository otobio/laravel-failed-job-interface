<?php return [
    # Specify the URL prefix for the interface
    'prefix'    => 'admin',

    # Specify the URL for the interface
    'url'             => 'failed-job-interface',

    # This middlewares will be called on the route group
    'middleware'      => [],

    # Pagination limit
    'per_page'        => 20,

    # Do you use Horizon? Null matches auto-detect
    'uses_horizon'    => null,

    # If you load the interface, do you want the filters collapsed?
    'display_filters' => false,

    # default or simple    
    'paginator_kind' => 'simple',
];