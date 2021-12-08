<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Service\Slugify;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class UserFixtures extends Fixture
{
    public const USERS = [
        [
            'firstname' => 'nathan',
            'lastname' => 'chapelle',
            'pseudo' => 'Nathan_C',
            'email' => 'nathanchapelle76@gmail.com',
            'password' => 'jdbfqks',
            'profile_picture' => null,
        ],
        [
            'firstname' => 'Clément',
            'lastname' => 'Eischen',
            'pseudo' => 'leklem',
            'email' => 'grokon@gmail.com',
            'password' => 'oisdqhf',
            'profile_picture' => null,
        ]
    ];
    public function load(ObjectManager $manager): void
    {
        foreach (self::USERS as $key => $user) {
            $newUser = new User();
            $slug = new Slugify();
            $newUser->setFirstname($user['firstname']);
            $newUser->setLastname($user['lastname']);
            $newUser->setPseudo($user['pseudo']);
            $newUser->setEmail($user['email']);
            $newUser->setPassword($user['password']);
            $newUser->setProfilePicture($user['profile_picture']);
            $newUser->setSlug($slug->generate($newUser->getPseudo()));
            $manager->persist($newUser);
            $this->setReference('user_' . $key, $newUser);
        }
        $manager->flush();
    }
}
