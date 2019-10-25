<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

use App\Entity\Services;

class ServicesFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
    	for ($i=1; $i < 3; $i++) { 
    		$service = new Services();
    		$service->setService("Titre du service n$i")
    				->setDescription("Description du service")
    				->setPicture("http://placehold.it/450x250");
        	
        	$manager->persist($service);
    	}

        $manager->flush();
    }
}
