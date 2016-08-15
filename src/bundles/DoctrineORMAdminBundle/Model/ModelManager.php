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

use Bruery\DoctrineORMAdminBundle\Datagrid\ProxyQuery;
use Bruery\CoreBundle\Model\SettingsManagerInterface;
use Sonata\DoctrineORMAdminBundle\Model\ModelManager as BaseModelManager;
use Symfony\Component\Form\Exception\PropertyAccessDeniedException;

class ModelManager extends BaseModelManager
{
    protected $settingsManager;

    /**
     * {@inheritdoc}
     */
    public function createQuery($class, $alias = 'o')
    {
        $repository = $this->getEntityManager($class)->getRepository($class);
        return new ProxyQuery($repository->createQueryBuilder($alias), $this->settingsManager);
    }

    /**
     * @return mixed
     */
    public function getSettingsManager()
    {
        return $this->settingsManager;
    }

    /**
     * @param mixed $settingsManager
     */
    public function setSettingsManager(SettingsManagerInterface $settingsManager)
    {
        $this->settingsManager = $settingsManager;
    }
}
