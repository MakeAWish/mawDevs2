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

        /**
         * *********************
         *        Users
         * *********************
         */

        $users = [];

        $userAdmin = new User();
        $userAdmin->setUsername('admin');
        $userAdmin->setEmail('borisschapira+admin@gmail.com');
        $userAdmin->setRoles(['ROLE_ADMIN']);
        $userAdmin->setEnabled(true);
        $userAdmin->setPlainPassword('admin');
        $manager->persist($userAdmin);
        $users[] = $userAdmin;

        $userUser = new User();
        $userUser->setUsername('user');
        $userUser->setEmail('borisschapira+user@gmail.com');
        $userUser->setRoles(['ROLE_USER']);
        $userUser->setEnabled(true);
        $userUser->setPlainPassword('user');
        $manager->persist($userUser);
        $users[] = $userUser;

        /**
         * *********************
         *        Categories
         * *********************
         */

        $categorySlugs = [
            'voyage',
            'multimédia',
            'animaux',
            'mode',
            'sport',
            'décoration',
            'culture',
            'jardinage'
        ];

        $categories = [];

        foreach($categorySlugs as $slug) {
            $category = new Category();
            $category->setName(ucfirst("Voyage"));
            $category->setSlug($slug);
            $manager->persist($category);
            $categories[] = $category;
        }

        /**
         * *********************
         *        Wishes
         * *********************
         */

        foreach($users as $user){
            for ($i = 0; $i < 10; $i++) {
                $wish = new Wish();
                $wish->setTitle('Vœu #'.$i);
                $wish->setDescription('Description du vœu #'.$i);
                $wish->setUser($user);
                $wish->setCategory($categories[rand(0,count($categories)-1)]);
                if(rand(0,9) % 3 == 0){
                    $wish->setLink('https://borisschapira.com');
                }
                $manager->persist($wish);
            }
        }

        $manager->flush();
    }
}