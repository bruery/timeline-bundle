<?php
/**
 * This file is part of the Bruery Platform.
 *
 * (c) Viktore Zara <viktore.zara@gmail.com>
 * (c) Mell Zamora <mellzamora@outlook.com>
 *
 * Copyright (c) 2016. For the full copyright and license information, please view the LICENSE  file that was distributed with this source code.
 */

namespace Bruery\DoctrineORMAdminBundle\Datagrid;

use Bruery\CoreBundle\Model\SettingsManagerInterface;
use Doctrine\Common\Collections\Criteria;
use Doctrine\ORM\Query;
use Sonata\DoctrineORMAdminBundle\Datagrid\ProxyQuery as BaseProxyQuery;

/**
 * This class try to unify the query usage with Doctrine.
 */
class ProxyQuery extends BaseProxyQuery
{

    protected $settingsManager;
    /**
     * @param QueryBuilder $queryBuilder
     */
    public function __construct($queryBuilder, SettingsManagerInterface $settingsManager = null)
    {
        parent::__construct($queryBuilder);
        $this->settingsManager = $settingsManager;
    }

    /**
     * {@inheritdoc}
     */
    public function execute(array $params = array(), $hydrationMode = null)
    {
        // always clone the original queryBuilder
        $queryBuilder = clone $this->queryBuilder;

        $rootAlias = current($queryBuilder->getRootAliases());

        // todo : check how doctrine behave, potential SQL injection here ...
        if ($this->getSortBy()) {
            $sortBy = $this->getSortBy();
            if (strpos($sortBy, '.') === false) { // add the current alias
                $sortBy = $rootAlias.'.'.$sortBy;
            }
            $queryBuilder->addOrderBy($sortBy, $this->getSortOrder());
        } else {
            $queryBuilder->resetDQLPart('orderBy');
        }

        /* By default, always add a sort on the identifier fields of the first
         * used entity in the query, because RDBMS do not guarantee a
         * particular order when no ORDER BY clause is specified, or when
         * the field used for sorting is not unique.
         */

        $identifierFields = $queryBuilder
            ->getEntityManager()
            ->getMetadataFactory()
            ->getMetadataFor(current($queryBuilder->getRootEntities()))
            ->getIdentifierFieldNames();

        $existingOrders = array();
        /** @var Query\Expr\OrderBy $order */
        foreach ($queryBuilder->getDQLPart('orderBy') as $order) {
            foreach ($order->getParts() as $part) {
                $existingOrders[] = trim(str_replace(array(Criteria::DESC, Criteria::ASC), '', $part));
            }
        }

        foreach ($identifierFields as $identifierField) {
            $order = $rootAlias.'.'.$identifierField;
            if (!in_array($order, $existingOrders)) {
                $queryBuilder->addOrderBy(
                    $order,
                    $this->getSortOrder() // reusing the sort order is the most natural way to go
                );
            }
        }

        if($this->settingsManager && $this->settingsManager->getSettings('enabled') && $this->settingsManager->getSettings('ttl')) {
            return $this->getFixedQueryBuilder($queryBuilder)
                ->setCacheable(true)
                ->getQuery()
                ->useQueryCache(true, $this->settingsManager->getSettings('ttl'))
                ->useResultCache(true, $this->settingsManager->getSettings('ttl'))
                ->execute($params, $hydrationMode);
        } else {
            return $this->getFixedQueryBuilder($queryBuilder)
                ->getQuery()
                ->execute($params, $hydrationMode);
        }
    }
}
