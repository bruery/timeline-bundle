<?php
/**
 * This file is part of the Bruery Platform.
 *
 * (c) Viktore Zara <viktore.zara@gmail.com>
 * (c) Mell Zamorw <mellzamora@outlook.com>
 *
 * Copyright (c) 2016. For the full copyright and license information, please view the LICENSE  file that was distributed with this source code.
 */

namespace Bruery\CoreBundle\Provider;

interface PoolInterface
{
    public function getProvider($name);

    public function addProvider($name, ProviderInterface $instance);

    public function setProviders($providers);

    public function getProviders();

    public function addGroup($name, $provider = null);

    public function hasGroup($name);

    public function getGroup($name);

    public function getGroups();

    public function getDefaultGroup();

    public function getProviderNameByGroup($name);
}
