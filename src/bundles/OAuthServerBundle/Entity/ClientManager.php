<?php
/**
 * This file is part of the Bruery Platform.
 *
 * (c) Viktore Zara <viktore.zara@gmail.com>
 * (c) Mell Zamorw <mellzamora@outlook.com>
 *
 * Copyright (c) 2016. For the full copyright and license information, please view the LICENSE  file that was distributed with this source code.
 */

namespace Bruery\OAuthServerBundle\Entity;

use Sonata\CoreBundle\Model\BaseEntityManager;
use FOS\OAuthServerBundle\Model\ClientInterface;

class ClientManager extends BaseEntityManager
{
    /**
     * {@inheritdoc}
     */
    public function findClientBy(array $criteria)
    {
        return $this->findOneBy($criteria);
    }

    /**
     * {@inheritdoc}
     */
    public function updateClient(ClientInterface $client)
    {
        $this->em->persist($client);
        $this->em->flush();
    }

    /**
     * {@inheritdoc}
     */
    public function deleteClient(ClientInterface $client)
    {
        $this->delete($client)
    }

    /**
     * {@inheritdoc}
     */
    public function findClientByPublicId($publicId)
    {
        if (false === $pos = strpos($publicId, '_')) {
            return;
        }

        $id = substr($publicId, 0, $pos);
        $randomId = substr($publicId, $pos + 1);

        return $this->findClientBy(array(
            'id'       => $id,
            'randomId' => $randomId,
        ));
    }
}
