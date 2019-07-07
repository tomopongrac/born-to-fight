# Description
This is a little app which simulates battle between two armies. Each army have N units. N is getting from GET parameter (?army1=50&army=48).

App is made in Laravel 5.8

Clone repository

```
git clone https://github.com/tomopongrac/born-to-fight.git
```

Open directory

```
cd born-to-fight
```

Start the server
```
php artisan serve
```

Open the link and start the app

```
http://127.0.0.1:8000/?army1=100&army2=100
```

There is a test in phpunit and phpspec which you can run by command
```
composer run-tests
```
For running squizlabs/PHP_CodeSniffer run command
```
composer fix-cs
```
For running nunomaduro/larastan run command
```
composer analyze-code
```


# Units
There is two types of units, one is regular units and other is general unit which is only one in army.

Units are located in config files where you can add another types or change attributes of each unit.

Attributes are:
- type
- strength 
- armour
- accuracy
- maxHealth
- morale

Config files are located in /config/app/units.php and /config/app/general.php

If you want to change where your units are stored (for instance in db) you need to create service which implements interface \App\Service\UnitsLoaderInterface and than bind new service in app/Providers/AppServiceProvider.php on method register. Bellow is how it looks now.

```
$this->app->bind(UnitsLoaderInterface::class, ConfigUnitsLoader::class);
```

# Features
- on each turn there is randomly selected attacker and defender
- after each turn both armies are regenerated
- before each attack defender is have possibility that runs from the battle and then defender is automatically slain
- if general is slain all units in his army get morale divided by half
- after attacker is slain defender he gain experience and he raises attributes