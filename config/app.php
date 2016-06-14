<?php
return [
    /**
     * Debug Level:
     *
     * Production Mode:
     * false: No error messages, errors, or warnings shown.
     *
     * Development Mode:
     * true: Errors and warnings shown.
     */
    'debug' => true,

    'App' => [
        'namespace' => 'App',
        'encoding' => 'UTF-8',
        'base' => false,
        'dir' => 'src',
        'webroot' => 'webroot',
        'wwwRoot' => WWW_ROOT,
        // 'baseUrl' => env('SCRIPT_NAME'),
        'fullBaseUrl' => false,
        'imageBaseUrl' => 'img/',
        'cssBaseUrl' => 'css/',
        'jsBaseUrl' => 'js/',
        'paths' => [
            'plugins' =>    [ROOT . DS . 'plugins' . DS],
            'templates' =>  [APP . 'Template' . DS],
            'locales' =>    [APP . 'Locale' . DS],
        ],
    ],

    'Security' => [
        'salt' => 'e529e94cc63a4a781589ec35c40d6a88ca206d988ecc351c7e8a8957b96d47d3',
    ],


    'Asset' => [
        // 'timestamp' => true,
    ],


    'Cache' => [
        'default' => [
            'className' => 'File',
            'path' => CACHE,
        ],


        '_cake_core_' => [
            'className' => 'File',
            'prefix' => 'myapp_cake_core_',
            'path' => CACHE . 'persistent/',
            'serialize' => true,
            'duration' => '+2 minutes',
        ],

        '_cake_model_' => [
            'className' => 'File',
            'prefix' => 'myapp_cake_model_',
            'path' => CACHE . 'models/',
            'serialize' => true,
            'duration' => '+2 minutes',
        ],
    ],

    'Error' => [
        'errorLevel' => E_ALL & ~E_DEPRECATED,
        'exceptionRenderer' => 'Cake\Error\ExceptionRenderer',
        'skipLog' => [],
        'log' => true,
        'trace' => true,
    ],

    /**
     * Email configuration.
     *
     * By defining transports separately from delivery profiles you can easily
     * re-use transport configuration across multiple profiles.
     *
     * You can specify multiple configurations for production, development and
     * testing.
     *
     * Each transport needs a `className`. Valid options are as follows:
     *
     *  Mail   - Send using PHP mail function
     *  Smtp   - Send using SMTP
     *  Debug  - Do not send the email, just return the result
     *
     * You can add custom transports (or override existing transports) by adding the
     * appropriate file to src/Mailer/Transport.  Transports should be named
     * 'YourTransport.php', where 'Your' is the name of the transport.
     */
    'EmailTransport' => [
        'default' => [
            'className' => 'Mail',
            // The following keys are used in SMTP transports
            'host' => 'localhost',
            'port' => 25,
            'timeout' => 30,
            'username' => 'user',
            'password' => 'secret',
            'client' => null,
            'tls' => null,
        ],
        'smtpMail' => [
            'className' => 'Smtp',
            // The following keys are used in SMTP transports
            'host' => 'smtp.office365.com',
            'port' => 587,
            'timeout' => 30,
            'username' => 'flavio.motta@cssj.com.br',
            'password' => 'teste',
            'tls' => true,
        ],
    ],

    /**
     * Email delivery profiles
     *
     * Delivery profiles allow you to predefine various properties about email
     * messages from your application and give the settings a name. This saves
     * duplication across your application and makes maintenance and development
     * easier. Each profile accepts a number of keys. See `Cake\Mailer\Email`
     * for more information.
     */
    'Email' => [
        'default' => [
            'transport' => 'smtpMail',
            'from' => 'flavio.motta@cssj.com.br',
            'charset' => 'utf-8'
        ],
    ],

    /**
     * Connection information used by the ORM to connect
     * to your application's datastores.
     * Drivers include Mysql Postgres Sqlite Sqlserver
     * See vendor\cakephp\cakephp\src\Database\Driver for complete list
     */
    'Datasources' => [

        'default' => [
           'className' => 'CakeDC\OracleDriver\Database\OracleConnection',
           'driver' => 'CakeDC\OracleDriver\Database\Driver\OracleOCI', # For OCI8
           #'driver' => 'CakeDC\\OracleDriver\\Database\\Driver\\OraclePDO', # For PDO_OCI
           'host' => '172.20.0.33',          # Database host name or IP address
           //'port' => '1521', # Database port number (default: 1521)
           'username' => 'DRPLUS',          # Database username
           'password' => '9Czujgwq',       # Database password
           'database' => 'webaux',             # Database name (maps to Oracle's `SERVICE_NAME`)
           'sid' => '',                    # Database System ID (maps to Oracle's `SID`)
           'instance' => '',               # Database instance name (maps to Oracle's `INSTANCE_NAME`)
           'pooled' => '',                 # Database pooling (maps to Oracle's `SERVER=POOLED`)
           'quoteIdentifiers' => false
       ],

        // 'default' => [
        //    'className' => 'CakeDC\OracleDriver\Database\OracleConnection',
        //    'driver' => 'CakeDC\OracleDriver\Database\Driver\OracleOCI', # For OCI8
        //    #'driver' => 'CakeDC\\OracleDriver\\Database\\Driver\\OraclePDO', # For PDO_OCI
        //    'host' => 'cssjora-scan.interno.acsc.org.br',          # Database host name or IP address
        //    //'port' => '1521', # Database port number (default: 1521)
        //    'username' => 'dbamv',          # Database username
        //    'password' => 'gdqd87it',       # Database password
        //    'database' => 'soulprd',        # Database name (maps to Oracle's `SERVICE_NAME`)
        //    'sid' => '',                    # Database System ID (maps to Oracle's `SID`)
        //    'instance' => '',               # Database instance name (maps to Oracle's `INSTANCE_NAME`)
        //    'pooled' => '',                 # Database pooling (maps to Oracle's `SERVER=POOLED`)
        //    'quoteIdentifiers' => false
        // ]

    ],

    'Log' => [
        'debug' => [
            'className' => 'Cake\Log\Engine\FileLog',
            'path' => LOGS,
            'file' => 'debug',
            'levels' => ['notice', 'info', 'debug'],
        ],
        'error' => [
            'className' => 'Cake\Log\Engine\FileLog',
            'path' => LOGS,
            'file' => 'error',
            'levels' => ['warning', 'error', 'critical', 'alert', 'emergency'],
        ],
    ],

    'Session' => [
        'defaults' => 'php',
        'timeout' => 30,
        'cookieTime' => 1440,
        'autoRegenerate' => true
    ],
];
