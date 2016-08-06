<?php

/**
 * This file is part of the Bruery Platform.
 *
 * (c) Viktore Zara <viktore.zara@gmail.com>
 * (c) Mell Zamorw <mellzamora@outlook.com>
 *
 * Copyright (c) 2016. For the full copyright and license information, please view the LICENSE  file that was distributed with this source code.
 */

namespace Bruery\DoctrineORMAdminBundle\Filter;

use Sonata\DoctrineORMAdminBundle\Filter\NumberFilter as BaseNumberFilter;
use Sonata\AdminBundle\Form\Type\Filter\NumberType;

class NumberFilter extends BaseNumberFilter
{
    /**
     * @param string $type
     *
     * @return bool
     */
    private function getOperator($type)
    {
        $choices = array(
            NumberType::TYPE_EQUAL            => '=',
            NumberType::TYPE_GREATER_EQUAL    => '>=',
            NumberType::TYPE_GREATER_THAN     => '>',
            NumberType::TYPE_LESS_EQUAL       => '<=',
            NumberType::TYPE_LESS_THAN        => '<',
        );

        return isset($choices[$type]) ? $choices[$type] : false;
    }

    /**
     * {@inheritdoc}
     */
    public function getDefaultOptions()
    {
        return array();
    }

    /**
     * {@inheritdoc}
     */
    public function getRenderSettings()
    {
        return array('sonata_type_filter_number', array(
            'field_type'    => $this->getFieldType(),
            'field_options' => $this->getFieldOptions(),
            'label'         => $this->getLabel(),
            'operator_options' => $this->getOption('operator_options') ? $this->getOption('operator_options'): array(),
        ));
    }
}
