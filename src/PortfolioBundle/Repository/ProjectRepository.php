<?php

namespace PortfolioBundle\Repository;

use Doctrine\ORM\EntityRepository;



class ProjectRepository extends EntityRepository{


    public function getQueryBuilder(array $params = array()){

        $qb = $this->createQueryBuilder('p');

        $qb ->select('p, c, t')
            ->leftJoin('p.category', 'c')
            ->leftJoin('p.tags', 't')
            ->orderBy('p.publishedDate', 'DESC');


        if(!empty($params['home'])){
            $qb ->where('p.homePage = :true')
                ->setParameter('true', true);


        }

        return $qb;
    }

}