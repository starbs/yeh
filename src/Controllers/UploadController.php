<?php

/**
 * This file is part of Yeh by Graham Campbell.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */

namespace GrahamCampbell\Yeh\Controllers;

class ShortenController extends AbstractController
{
    protected function fire()
    {
        $image = $this->file('image');

        if (!$image) {
            return $this->error(['message'  => 'No Image Provided'], 400);
        }

        if (!$image->isValid()) {
            return $this->error(['message'  => 'The Image Was Corrupt'], 400);
        }

        if (strtolower(substr($image->getMimeType(), 0, 5)) !== 'image') {
            return $this->error(['message'  => 'Only Images Are Allowed'], 400);
        }

        $url = $this->app['factory']->save($image);

        if ($this->input('sharex')) {
            return $this->raw($url, 'text/plain');
        }

        return $this->success(['message'  => 'Image Uploaded Successfully', 'url' => $url]);
    }
}
