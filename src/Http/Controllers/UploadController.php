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

namespace Starbs\Yeh\Http\Controllers;

use Starbs\Http\Controllers\AbstractController;

class UploadController extends AbstractController
{
    /**
     * Do some clever things, then return a response.
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    protected function fire()
    {
        $image = $this->file('image');

        if (!$image) {
            return $this->error(['message'  => 'No image provided'], 400);
        }

        if (!$image->isValid()) {
            return $this->error(['message'  => 'The image was corrupt'], 400);
        }

        if (strtolower(substr($image->getMimeType(), 0, 5)) !== 'image') {
            return $this->error(['message'  => 'Only images are allowed'], 415);
        }

        $url = $this->container->get('factory')->save($image);
        
        /* ShareX Compatability*/
        if ($this->input('sharex')) {
            return $this->raw($url, 'text/plain');
        }

        return $this->success(['message'  => 'Image uploaded successfully', 'url' => $url]);
    }
}
