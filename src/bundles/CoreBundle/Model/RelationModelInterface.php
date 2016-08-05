<?php
/**
 * This file is part of the Bruery Platform.
 *
 * (c) Viktore Zara <viktore.zara@gmail.com>
 * (c) Mell Zamorw <mellzamora@outlook.com>
 *
 * Copyright (c) 2016. For the full copyright and license information, please view the LICENSE  file that was distributed with this source code.
 */

namespace Bruery\CoreBundle\Model;

interface RelationModelInterface
{
    /**
     * {@inheritdoc}
     */
    public function setCreatedAt(\DateTime $createdAt = null);

    /**
     * {@inheritdoc}
     */
    public function getCreatedAt();

    /**
     * {@inheritdoc}
     */
    public function setEnabled($enabled);

    /**
     * {@inheritdoc}
     */
    public function getEnabled();

    /**
     * {@inheritdoc}
     */
    public function setPosition($position);

    /**
     * {@inheritdoc}
     */
    public function getPosition();

    /**
     * {@inheritdoc}
     */
    public function setUpdatedAt(\DateTime $updatedAt = null);

    /**
     * {@inheritdoc}
     */
    public function getUpdatedAt();
}
