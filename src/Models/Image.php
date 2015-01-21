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

namespace Starbs\Yeh\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    /**
     * A list of methods protected from mass assignment.
     *
     * @var array
     */
    protected $guarded = ['_token', '_method', 'id'];
}
