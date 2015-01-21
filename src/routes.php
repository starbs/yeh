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

$app->get('/', 'Starbs\Yeh\Http\Controllers\HomeController::index');

$app->post('/', 'Starbs\Yeh\Http\Controllers\UploadController::index');

$app->get('/{id}', 'Starbs\Yeh\Http\Controllers\MainController::index');
