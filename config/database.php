<?php

return [

    /*
    |--------------------------------------------------------------------------
    | PDO Fetch Style
    |--------------------------------------------------------------------------
    |
    | By default, database results will be returned as instances of the PHP
    | stdClass object; however, you may desire to retrieve records in an
    | array format for simplicity. Here you can tweak the fetch style.
    |
    */

    'fetch' => PDO::FETCH_CLASS,

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
    | 是否开启事务
    |--------------------------------------------------------------------------
    | 是否主动开启，配置为是，在put、delete、post请求时会主动开启事务，开发人员不必在代码里
    | 添加开启事务代码，开始事务、提交事务、回滚事务会再中间件自动处理，配置为否时，所有的请求
    | 都不开启事务
    |
    */
    'transaction' => env('DB_TRANSACTION', false),
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

        'testing' => [
            'driver' => 'sqlite',
            'database' => ':memory:',
        ],

        'mysql' => [
            'driver' => 'mysql',
            'host' => env('DB_HOST', '147.114.90.54'),
            'port' => env('DB_PORT', 3306),
            'database' => env('DB_DATABASE', 'matchexpo_new'),
            'username' => env('DB_USERNAME', 'matchexpo'),
            'password' => env('DB_PASSWORD', 'matchexpo0823!@'),
            'charset' => env('DB_CHARSET', 'utf8mb4'),
            'collation' => env('DB_COLLATION', 'utf8mb4_general_ci'),
            'prefix' => env('DB_PREFIX', ''),
            'timezone' => env('DB_TIMEZONE', '+08:00'),
            'strict' => env('DB_STRICT_MODE', false),
//            'options'   => [
//                MYSQLI_OPT_INT_AND_FLOAT_NATIVE => true,
//                PDO::ATTR_PERSISTENT => true,
//            ]
//            MYSQLI_OPT_INT_AND_FLOAT_NATIVE=>true
        ],

        'mongodb' => [
            'driver' => 'mongodb',
            'host' => env('MONGO_HOST', 'localhost'),
            'port' => env('MONGO_PORT', 27017),
            'database' => env('MONGO_DATABASE'),
            'username' => env('MONGO_USERNAME'),
            'password' => env('MONGO_PASSWORD'),
            'options' => [
                'database' => 'admin' // sets the authentication database required by mongo 3
            ]
        ],

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

        'cluster' => env('REDIS_CLUSTER', false),

        'default' => [
            'host' => env('REDIS_HOST', '127.0.0.1'),
            'port' => env('REDIS_PORT', 6379),
            'database' => env('REDIS_DATABASE', 0),
            'password' => env('REDIS_PASSWORD', null),
            'read_write_timeout' => -1,
        ],

    ],
    'max_idle_time' => env('DB_MAX_IDLE_TIME', 30),

];
