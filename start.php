<?php

/*
 * This file is part of Starbs Yeh.
 *
 * (c) Graham Campbell <graham@mineuk.com>
 * (c) Michael Banks <chip@mineuk.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

require __DIR__.'/vendor/autoload.php';

$app = new Proton\Application();
$app['Proton\Application'] = $app;

$config = require __DIR__.'/config/app.php';

foreach ($config as $key => $value) {
    $app[$key] => $value;
}

unset($config);

require __DIR__.'/src/database.php';
require __DIR__.'/src/bindings.php';
