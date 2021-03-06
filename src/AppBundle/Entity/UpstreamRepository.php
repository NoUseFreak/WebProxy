<?php

namespace AppBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * UpstreamRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class UpstreamRepository extends EntityRepository
{
    /**
     * @return Upstream[]
     */
    public function findAllEnabled()
    {
        return $this->createQueryBuilder('u')
            ->join('ClasticNodeBundle:Node', 'n', 'WITH', 'n = u.node')
            ->getQuery()
            ->getResult();
    }
}
