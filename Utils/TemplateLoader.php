<?php
/**
 * This file is part of the Bruery Platform.
 *
 * (c) Viktore Zara <viktore.zara@gmail.com>
 * (c) Mell Zamorw <mellzamora@outlook.com>
 *
 * Copyright (c) 2016. For the full copyright and license information, please view the LICENSE  file that was distributed with this source code.
 */

namespace Bruery\CoreBundle\Utils;

use Bruery\CoreBundle\Utils\TemplateLoaderInterface;

class TemplateLoader implements TemplateLoaderInterface
{
    protected $templates    = [];

    /**
     * @param array $templates
     *
     * @return void
     */
    public function setTemplates(array $templates)
    {
        $this->templates = array_merge($this->templates, $templates);
    }

    /**
     * @return array
     */
    public function getTemplates()
    {
        return $this->templates;
    }

    /**
     * @param string $name
     *
     * @return null|string
     */
    public function getTemplate($name)
    {
        if (isset($this->templates[$name])) {
            return $this->templates[$name];
        }
        return null;
    }
}
