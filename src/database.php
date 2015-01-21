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

$db = new Illuminate\Database\Capsule\Manager();

$db->addConnection(require __DIR__.'/../config/database.php');

$db->setAsGlobal();
$db->bootEloquent();
