for Meta table we are using 
Zoha-laravel-meta

Run following commands
composer require zoha/laravel-meta

php artisan vendor:publish --provider="Zoha\Meta\MetaServiceProvider" --tag=config
this command will create mete.php in config folder. goto this file and update table index

'tables' => [
    'default' => 'meta',
    'custom'  => [
        'valuation_property_meta'
    ],
]

then run
php artisan migrate
