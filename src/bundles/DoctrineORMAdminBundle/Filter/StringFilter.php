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
use Sonata\DoctrineORMAdminBundle\Filter\StringFilter as BaseStringFilter;

use Sonata\AdminBundle\Form\Type\Filter\ChoiceType;

class StringFilter extends BaseStringFilter
{

    /**
     * @param string $type
     *
     * @return bool
     */
    private function getOperator($type)
    {
        $choices = array(
            ChoiceType::TYPE_CONTAINS         => 'LIKE',
            ChoiceType::TYPE_NOT_CONTAINS     => 'NOT LIKE',
            ChoiceType::TYPE_EQUAL            => '=',
        );

        return isset($choices[$type]) ? $choices[$type] : false;
    }

    /**
     * {@inheritdoc}
     */
    public function getRenderSettings()
    {
        return array('sonata_type_filter_choice', array(
            'field_type'    => $this->getFieldType(),
            'field_options' => $this->getFieldOptions(),
            'label'         => $this->getLabel(),
            'operator_options' => $this->getOption('operator_options') ? $this->getOption('operator_options'): array(),
        ));
    }
}
