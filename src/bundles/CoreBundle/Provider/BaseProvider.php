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

abstract class BaseProvider implements ProviderInterface
{
    protected $name;
    protected $translator;
    protected $slugify;
    protected $defaultSettings;
    protected $rawSettings;
    protected $settings;

    /**
     * @param string                                           $name
     */
    public function __construct($name)
    {
        $this->name = $name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getTranslator()
    {
        return $this->translator;
    }

    public function setTranslator($translator)
    {
        $this->translator = $translator;
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

    /**
     * @return mixed
     */
    public function getRawSettings()
    {
        return $this->rawSettings;
    }

    /**
     * @param mixed $rawSettings
     */
    public function setRawSettings($rawSettings)
    {
        $this->rawSettings = $rawSettings;
        $this->processSettings();
    }

    /**
     * @return mixed
     */
    public function getSettings()
    {
        return $this->settings;
    }

    /**
     * @param mixed $settings
     */
    public function setSettings($settings)
    {
        $this->settings = $settings;
    }

    /**
     * {@inheritDoc}
     */
    public function getSetting($name, $default = null)
    {
        return isset($this->settings[$name]) ? $this->settings[$name] : $default;
    }

    /**
     * {@inheritDoc}
     */
    public function setSetting($name, $value)
    {
        $this->settings[$name] = $value;
    }

    public function processSettings()
    {
        if (!$this->getRawSettings()) {
            return null;
        }
        foreach ($this->getRawSettings() as $key=>$rawSetting) {
            $setting = [];
            foreach ($rawSetting['params'] as $val) {
                $setting[$val['key']] = $val['value'];
            }
            $this->setSetting($key, $setting);
        }
    }

    /**
     * @return mixed
     */
    public function getDefaultSettings()
    {
        return $this->defaultSettings;
    }

    /**
     * @param mixed $settings
     */
    public function setDefaultSettings($defaultSettings)
    {
        $this->defaultSettings = $defaultSettings;
    }

    /**
     * {@inheritDoc}
     */
    public function getDefaultSetting($name, $default = null)
    {
        return isset($this->defaultSettings[$name]) ? $this->defaultSettings[$name] : $default;
    }

    /**
     * {@inheritDoc}
     */
    public function setDefaultSetting($name, $value)
    {
        $this->defaultSettings[$name] = $value;
    }
}
