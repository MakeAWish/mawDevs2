<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Category;
use AppBundle\Entity\Wish;
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

        $category = new Category();
        $category->setName("Default");
        $category->setSlug('default');
        $manager->persist($category);

        for ($i = 0; $i < 10; $i++) {
            $wish = new Wish();
            $wish->setTitle('Vœu #'.$i);
            $wish->setDescription('Description du vœu #'.$i);
            $wish->setUser($userAdmin);
            $wish->setCategory($category);
            $manager->persist($wish);
        }

        $manager->flush();
    }
}