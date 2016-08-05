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

interface ProviderInterface
{
    public function setName($name);

    public function getName();

    public function getTranslator();

    public function setTranslator($translator);

    /**
     * @return mixed
     */
    public function getSlugify();

    /**
     * @param mixed $slugify
     */
    public function setSlugify($slugify);
}
