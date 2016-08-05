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

use Sonata\CoreBundle\Validator\ErrorElement;

abstract class BasePool implements PoolInterface
{
    protected $providers = array();

    protected $groups = array();

    protected $defaultGroup;

    protected $slugify;

    /**
     * @param string $collection
     */
    public function __construct($group)
    {
        $this->defaultGroup = $group;
    }

    public function getProvider($name)
    {
        if (!isset($this->providers[$name])) {
            throw new \RuntimeException(sprintf('unable to retrieve the provider named : `%s`', $name));
        }

        return $this->providers[$name];
    }

    /**
     * @param string                 $name
     * @param PostProviderInterface $instance
     *
     * @return void
     */
    public function addProvider($name, ProviderInterface $instance)
    {
        $this->providers[$name] = $instance;
    }

    public function setProviders($providers)
    {
        $this->providers = $providers;
    }

    public function getProviders()
    {
        return $this->providers;
    }

    public function addGroup($name, $provider = null)
    {
        if (!$this->hasGroup($name)) {
            $this->groups[$name] = array('provider' => null);
        }
        $this->groups[$name]['provider'] = $provider;
    }

    public function hasGroup($name)
    {
        return isset($this->groups[$name]);
    }

    public function getGroup($name)
    {
        if (!$this->hasGroup($name)) {
            return null;
        }

        return $this->groups[$name];
    }

    public function getGroups()
    {
        return $this->groups;
    }

    public function getDefaultGroup()
    {
        return $this->defaultGroup;
    }

    public function getProviderNameByGroup($name)
    {
        $group = $this->getGroup($name);

        if (!$group) {
            return null;
        }

        return $group['provider'];
    }

    /**
     * @return mixed
     */
    public function getSlugify()
    {
        return $this->slugify;
    }

    /**
     * @param mixed $slugify
     */
    public function setSlugify($slugify)
    {
        $this->slugify = $slugify;
    }
}
