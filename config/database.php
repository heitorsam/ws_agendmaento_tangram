<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Database Connection Name
    |--------------------------------------------------------------------------
    |
    | Here you may specify which of the database connections below you wish
    | to use as your default connection for all database work. Of course
    | you may use many connections at once using the Database library.
    |
    */

    'default' => env('DB_CONNECTION', 'mysql'),

    /*
    |--------------------------------------------------------------------------
    | Database Connections
    |--------------------------------------------------------------------------
    |
    | Here are each of the database connections setup for your application.
    | Of course, examples of configuring each database platform that is
    | supported by Laravel is shown below to make development simple.
    |
    |
    | All database work in Laravel is done through the PHP PDO facilities
    | so make sure you have the driver for your particular database of
    | choice installed on your machine before you begin development.
    |
    */

    'connections' => [

        'sqlite' => [
            'driver' => 'sqlite',
            'database' => env('DB_DATABASE', database_path('database.sqlite')),
            'prefix' => '',
        ],

        'mysql' => [
            'driver' => 'mysql',
            'host' => env('DB_HOST', '127.0.0.1'),
            'port' => env('DB_PORT', '3306'),
            'database' => env('DB_DATABASE', 'forge'),
            'username' => env('DB_USERNAME', 'forge'),
            'password' => env('DB_PASSWORD', ''),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => true,
            'engine' => null,
        ],

        'pgsql' => [
            'driver' => 'pgsql',
            'host' => env('DB_HOST', '127.0.0.1'),
            'port' => env('DB_PORT', '5432'),
            'database' => env('DB_DATABASE', 'forge'),
            'username' => env('DB_USERNAME', 'forge'),
            'password' => env('DB_PASSWORD', ''),
            'charset' => 'utf8',
            'prefix' => '',
            'schema' => 'public',
            'sslmode' => 'prefer',
        ],

        'sqlsrv' => [
            'driver' => 'sqlsrv',
            'host' => env('DB_HOST', 'localhost'),
            'port' => env('DB_PORT', '1433'),
            'database' => env('DB_DATABASE', 'forge'),
            'username' => env('DB_USERNAME', 'forge'),
            'password' => env('DB_PASSWORD', ''),
            'charset' => 'utf8',
            'prefix' => '',
        ],

        // 'orcl' => [
        //     'driver'        => 'oracle',
        //     'tns'           => env('DB_TNS', 'ora11'),
        //     'host'          => env('DB_HOST', 'localhost'),
        //     'port'          => env('DB_PORT', '1521'),
        //     'database'      => env('DB_DATABASE', 'teste'),
        //     'username'      => env('DB_USERNAME', 'system'),
        //     'password'      => env('DB_PASSWORD', 'Dw67y443014$'),
        //     'charset'       => env('DB_CHARSET', 'AL32UTF8'),
        //     'prefix'        => env('DB_PREFIX', ''),
        //     'prefix_schema' => env('DB_SCHEMA_PREFIX', ''),
        //     'edition'       => env('DB_EDITION', ''),
        // ],
     'oracle' => [
                'driver' => 'oracle',
                'host' => '10.200.0.211',
                'port' => '1521',
                'database' => 'producao',
                'service_name' => 'prdmv',
                'username' => 'webservice',
                'password' => '123mudar',
                'charset' => 'utf8',
                'prefix' => '',
            ],
        'oracleSaude' => [
                'driver' => 'oracle',
                'host' => '10.201.21.2',
                'port' => '1521',
                'database' => 'ssaude',
                'service_name' => 'prdme',
                'username' => 'tangram',
                'password' => 'tangram2019',
                'charset' => 'utf8',
                'prefix' => '',
            ],


//             $con = oci_connect('system', 'Dw67y443014$', 'ora11');  
//         if( !$con  )
//         {
//             echo( "Erro ao conectar com o banco de dados." );
//             exit;
//         }
    
// $c = oci_connect ("system", "Dw67y443014$",'ora11'); 
// $s = oci_parse ($c, 'select * from clientes'); 
// oci_execute ($s); 
// while ($res = oci_fetch_array ($s, OCI_ASSOC)) { 
// var_dump ($res); 
// } 

    ],

    /*
    |--------------------------------------------------------------------------
    | Migration Repository Table
    |--------------------------------------------------------------------------
    |
    | This table keeps track of all the migrations that have already run for
    | your application. Using this information, we can determine which of
    | the migrations on disk haven't actually been run in the database.
    |
    */

    'migrations' => 'migrations',

    /*
    |--------------------------------------------------------------------------
    | Redis Databases
    |--------------------------------------------------------------------------
    |
    | Redis is an open source, fast, and advanced key-value store that also
    | provides a richer set of commands than a typical key-value systems
    | such as APC or Memcached. Laravel makes it easy to dig right in.
    |
    */

    'redis' => [

        'client' => 'predis',

        'default' => [
            'host' => env('REDIS_HOST', '127.0.0.1'),
            'password' => env('REDIS_PASSWORD', null),
            'port' => env('REDIS_PORT', 6379),
            'database' => 0,
        ],

    ],

];
