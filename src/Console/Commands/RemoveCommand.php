<?php

/*
 * This file is part of Starbs Yeh by Graham Campbell.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
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
        if ($this->app['factory']->remove($id)) {
            $this->output->writeln("<info>'$id' was removed from the database.</info>");
        } else {
            $this->output->writeln("<error>'$id' was not found in the database.</error>");
        }
    }
}
