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

namespace Starbs\Yeh\Console\Commands;

use InvalidArgumentException;
use Starbs\Console\Commands\AbstractCommand;
use Symfony\Component\Console\Input\InputArgument;

class RemoveCommand extends AbstractCommand
{
    /**
     * The command name.
     *
     * @var string
     */
    protected $name = 'remove';

    /**
     * The command description.
     *
     * @var string
     */
    protected $description = 'Remove the given ids from the database';

    /**
     * Configures the command.
     *
     * This method is called by the parent's constructor.
     *
     * @return void
     */
    protected function configure()
    {
        $this->addArgument('ids', InputArgument::IS_ARRAY, 'The ids to remove');
    }

    /**
     * Executes the command.
     *
     * @return void
     */
    protected function fire()
    {
        if ($ids = $this->input->getArgument('ids')) {
            foreach ($ids as $id) {
                $this->remove($id);
            }
        } else {
            throw new InvalidArgumentException('You need to provide one or more ids to remove.');
        }
    }

    /**
     * Remove the given id from the db.
     *
     * @param string $id
     *
     * @return void
     */
    protected function remove($id)
    {
        if ($this->container->get('factory')->remove($id)) {
            $this->output->writeln("<info>'$id' was removed from the database.</info>");
        } else {
            $this->output->writeln("<error>'$id' was not found in the database.</error>");
        }
    }
}
