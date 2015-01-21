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

extract(require __DIR__.'/config/app.php');
$app['debug'] = $debug;
$app['url'] = $url;

require __DIR__.'/src/database.php';
require __DIR__.'/src/bindings.php';
