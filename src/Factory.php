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
