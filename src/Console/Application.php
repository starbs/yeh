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

namespace Starbs\Yeh\Console;

use Starbs\Console\AbstractApplication;
use Starbs\Yeh\Console\Commands\RemoveCommand;

class Application extends AbstractApplication
{
    /**
     * The application name.
     *
     * @var string
     */
    protected $appName = 'Starbs Yeh';

    /**
     * The application version.
     *
     * @var string
     */
    protected $appVersion = '1.1.0-dev';

    /**
     * Setup the application.
     *
     * @return void
     */
    protected function setup()
    {
        $this->add($this->container->get(RemoveCommand::class));
    }
}
