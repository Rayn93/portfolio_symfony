<?php

namespace PortfolioBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
//use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use PortfolioBundle\Entity\Category;


class CategoriesFixtures extends AbstractFixture{


    public function load(ObjectManager $manager)
    {

        $CategoryList = array(
            'sklepy' =>'Sklepy internetowe',
            'blogi' => 'Blogi',
            'wizytowki'=> 'Strony wizytówki',
            'ciecie' => 'Cięcie szablonów',
            'moje' => 'Własne projekty',
        );

        foreach($CategoryList as $key => $value){

            $Category = new Category();
            $Category->setName($value);

            $manager->persist($Category);
        }

        $manager->flush();

    }
}