<?php
/**
 * This file is part of the Bruery Platform.
 *
 * (c) Viktore Zara <viktore.zara@gmail.com>
 * (c) Mell Zamorw <mellzamora@outlook.com>
 *
 * Copyright (c) 2016. For the full copyright and license information, please view the LICENSE  file that was distributed with this source code.
 */

namespace Bruery\CoreBundle\Twig\Extension;

use Bruery\CoreBundle\Utils\TemplateLoaderInterface;

class TemplateLoaderExtension extends \Twig_Extension
{
    /**
     * @var \Twig_Environment
     */
    protected $environment;

    /**
     * @var \Bruery\CoreBundle\Utils\TemplateLoaderInterface
     */
    protected $loader;

    /**
     * @param \Bruery\CoreBundle\Utils\TemplateLoaderInterface $loader
     */
    public function __construct(TemplateLoaderInterface $loader)
    {
        $this->loader = $loader;
    }

    /**
     * {@inheritdoc}
     */
    public function initRuntime(\Twig_Environment $environment)
    {
        $this->environment = $environment;
    }

    /**
     * Returns a list of functions to add to the existing list.
     *
     * @return array An array of functions
     */
    public function getFunctions()
    {
        return array(
             new \Twig_SimpleFunction('bruery_core_get_template', array($this, 'getTemplate')),
        );
    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'bruery_core_template_loader';
    }

    /**
     * @param $name
     *
     * @throws \Exception|\Twig_Error_Loader
     * @return \Twig_TemplateInterface
     */
    public function getTemplate($name)
    {
        dump($name);
        $templateName = $this->loader->getTemplate($name);
        try {
            $template = $this->environment->loadTemplate($templateName);
        } catch (\Twig_Error_Loader $e) {
            throw $e;
        }

        return $template;
    }
}
