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

namespace Starbs\Yeh\Controllers;

use Starbs\Http\Controllers\AbstractController;

class MainController extends AbstractController
{
    protected function fire()
    {
        $image = $this->app['factory']->get($this->args['id']);

        if ($image) {
            return $this->raw($image['image'], $image['mime']);
        }

        return $this->error(['message' => 'Not Found'], 404);
    }
}
