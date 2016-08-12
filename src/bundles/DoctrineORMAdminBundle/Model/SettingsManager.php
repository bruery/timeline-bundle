<?php

/**
 * This file is part of the Bruery Platform.
 *
 * (c) Viktore Zara <viktore.zara@gmail.com>
 * (c) Mell Zamora <mellzamora@outlook.com>
 *
 * Copyright (c) 2016. For the full copyright and license information, please view the LICENSE  file that was distributed with this source code.
 */

namespace Bruery\DoctrineORMAdminBundle\Model;

use Bruery\CoreBundle\Model\AbstractSettingsManager;

class SettingsManager extends AbstractSettingsManager
{
    /**
     * {@inheritdoc}
     */
    public function getSettings($id)
    {
        return isset($this->configs['doctrine_cache'][$id]) ? $this->configs['doctrine_cache'][$id] : null;
    }
}
