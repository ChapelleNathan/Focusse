<?php

namespace App\DataFixtures;

use App\Entity\Photo;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class PhotoFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        foreach (UserFixtures::USERS as $key => $user)
        {
            for ($i = 0; $i < 2; $i++)
            {
                $photo = new Photo();
                $photo->setUser($this->getReference('user_' . $key));
                $photo->setPath('https://img-19.ccm2.net/WNCe54PoGxObY8PCXUxMGQ0Gwss=/480x270/smart/d8c10e7fd21a485c909a5b4c5d99e611/ccmcms-commentcamarche/20456790.jpg');
                $photo->setPostedAt(new DateTime());
                $photo->setMessage('Ceci est le message de la photo');
                $manager->persist($photo);
            }
            
        }
        

        $manager->flush();
    }

    public function getDependencies()
    {
        return [UserFixtures::class];
    }
}
