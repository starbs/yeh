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

namespace Starbs\Yeh;

use Hashids\Hashids;
use Starbs\Yeh\Models\Image;
use Symfony\Component\HttpFoundation\File\File;

class Factory
{
    protected $hash;
    protected $url;

    public function __construct(Hashids $hash, $url)
    {
        $this->hash = $hash;
        $this->url = $url;
    }

    public function save(File $file)
    {
        $image = file_get_contents($file->getPathname());
        $hash = sha1($image);

        $model = Image::where('hash', $hash)->first();

        if (!$model) {
            $model = Image::create(['hash' => $hash, 'image' => $image, 'mime' => $file->getMimeType()]);
        }

        unset($image);
        unset($file);

        if ($model) {
            return $this->url($model->id);
        }
    }

    public function get($id)
    {
        $id = $this->decode($id);

        if ($model = Image::where('id', $id)->first()) {
            return ['mime' => $model->mime, 'image' => $model->image];
        }
    }

    public function remove($id)
    {
        $id = $this->decode($id);

        if ($model = Image::where('id', $id)->first()) {
            return $model->delete();
        }
    }

    protected function url($id)
    {
        $id = $this->encode($id);

        return $this->url.'/'.$id;
    }

    protected function encode($id)
    {
        return $this->hash->encode($id);
    }

    protected function decode($id)
    {
        if (is_numeric($id)) {
            return (int) $id;
        } else {
            return $this->hash->decode($id);
        }
    }
}
