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

namespace Starbs\Yeh\Http\Controllers;

use Starbs\Http\Controllers\AbstractController;

class HomeController extends AbstractController
{
    /**
     * Do some clever things, then return a response.
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    protected function fire()
    {
        return $this->success(['message' => 'You Have Arrived']);
    }
}
