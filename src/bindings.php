<?php

/*
 * This file is part of Starbs Yeh.
 *
 * (c) Graham Campbell <graham@mineuk.com>
 * (c) Chip Wolf <hello@chipwolf.uk>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

$app['hash'] = function () {
    return new Hashids\Hashids('yeh', 4);
};

$app['factory'] = function () use ($app) {
    return new Starbs\Yeh\Factory($app['hash'], $app['url']);
};
