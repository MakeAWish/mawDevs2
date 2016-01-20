<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\User;

class LoadUserData implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $userAdmin = new User();
        $userAdmin->setUsername('admin');
        $userAdmin->setEmail('borisschapira+admin@gmail.com');
        $userAdmin->setRoles(['ROLE_ADMIN']);
        $userAdmin->setEnabled(true);
        $userAdmin->setPlainPassword('admin');

        $manager->persist($userAdmin);

        $user = new User();
        $user->setUsername('user');
        $user->setEmail('borisschapira+user@gmail.com');
        $user->setRoles(['ROLE_USER']);
        $user->setEnabled(true);
        $user->setPlainPassword('user');

        $manager->persist($user);

        $manager->flush();
    }
}