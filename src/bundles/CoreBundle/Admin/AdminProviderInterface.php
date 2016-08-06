<?php
/**
 * This file is part of the Bruery Platform.
 *
 * (c) Viktore Zara <viktore.zara@gmail.com>
 * (c) Mell Zamora <mellzamora@outlook.com>
 *
 * Copyright (c) 2016. For the full copyright and license information, please view the LICENSE  file that was distributed with this source code.
 */

namespace Bruery\CoreBundle\Admin;

use Bruery\CoreBundle\Provider\PoolInterface;

interface AdminProviderInterface
{
    public function fetchProviderKey();

    public function getPoolProvider(PoolInterface $pool);

    public function getProviderName(PoolInterface $pool, $providerKey = null);
}
