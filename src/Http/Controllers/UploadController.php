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
            return $this->error(['message'  => 'No media provided'], 400);
        }

        if (!$image->isValid()) {
            return $this->error(['message'  => 'The media was corrupt'], 400);
        }

        $type = strtolower(substr($image->getMimeType(), 0, 5));

        if (!in_array($type, ['audio', 'image', 'video'])) {
            return $this->error(['message'  => 'Only media uploads are allowed'], 415);
        }

        $url = $this->container->get('factory')->save($image);

        if ($this->input('sharex')) {
            return $this->raw($url, 'text/plain');
        }

        return $this->success(['message'  => 'Image uploaded successfully', 'url' => $url]);
    }
}
