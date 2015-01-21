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

        if ($this->input('sharex')) {
            return $this->raw($url, 'text/plain');
        }

        return $this->success(['message'  => 'Image uploaded successfully', 'url' => $url]);
    }
}
