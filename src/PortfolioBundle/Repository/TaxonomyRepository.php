<?php

namespace PortfolioBundle\Repository;

use Doctrine\ORM\EntityRepository;



class TaxonomyRepository extends EntityRepository{


    public function getQueryBuilder(array $params = array()){

        $qb = $this->createQueryBuilder('t');

        $qb->select('t, COUNT(p.id) as postsCount')
            ->leftJoin('t.posts', 'p')
            ->groupBy('t.id');

        return $qb;

    }

}