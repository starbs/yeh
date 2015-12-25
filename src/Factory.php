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

namespace Starbs\Yeh;

use Hashids\Hashids;
use Starbs\Yeh\Models\Image;
use Symfony\Component\HttpFoundation\File\File;

class Factory
{
    protected $hash;
    protected $path;
    protected $url;

    public function __construct(Hashids $hash, $path, $url)
    {
        $this->hash = $hash;
        $this->path = $path;
        $this->url = $url;
    }

    public function save(File $file)
    {
        $image = file_get_contents($file->getPathname());
        $hash = sha1($image);

        $model = Image::where('hash', $hash)->first();

        if (!$model) {
            if (mb_strlen($request->getContent(), '8bit') > 1048576) {
                file_put_contents($this->path($id), $image);
                $model = Image::create(['hash' => $hash, 'mime' => $file->getMimeType()]);
            } else {
                $model = Image::create(['hash' => $hash, 'image' => $image, 'mime' => $file->getMimeType()]);
            }
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
            return ['mime' => $model->mime, 'image' => $model->image ?: file_get_contents($this->path($id))];
        }
    }

    public function remove($id)
    {
        $id = $this->decode($id);

        if ($model = Image::where('id', $id)->first()) {
            if (!$model->image) {
                unlink($this->path($id));
            }

            return $model->delete();
        }
    }

    protected function path($id)
    {
        return "{$this->path}/{$id}";
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
        return $this->hash->decode($id);
    }
}
