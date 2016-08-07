<?php

namespace PortfolioBundle\Repository;

use Doctrine\ORM\EntityRepository;



class ProjectRepository extends EntityRepository{


    public function getQueryBuilder(array $params = array()){

        $qb = $this->createQueryBuilder('p');

        $qb ->select('p, c, t')
            ->leftJoin('p.category', 'c')
            ->leftJoin('p.tags', 't');

        if(!empty($params['home'])){
            $qb ->where('p.homePage = :true')
                ->setParameter('true', true);
        }

        if(!empty($params['orderBy'])){
            $qb ->orderBy($params['orderBy'], $params['orderDir']);
        }

        if(!empty($params['tag'])){
            $qb ->andWhere('t.slug = :tag')
                ->setParameter('tag', $params['tag']);
        }

        if(!empty($params['category'])){
            $qb ->andWhere('c.slug = :category')
                ->setParameter('category', $params['category']);
        }

        return $qb;
    }

}