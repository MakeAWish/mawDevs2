<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Category;
use AppBundle\Entity\Wish;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\User;
use Faker\Factory;
use Faker\Provider\Internet;
use Faker\Provider\Lorem;
use Faker\Provider\fr_FR\Person;

class LoadUserData implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {

        /**
         * *********************
         *        Users
         * *********************
         */

        $faker = Factory::create('fr_FR');

        $users = [];

        $userAdmin = new User();
        $userAdmin->setUsername('admin');
        $userAdmin->setEmail('borisschapira+admin@gmail.com');
        $userAdmin->setRoles(['ROLE_ADMIN']);
        $userAdmin->setEnabled(true);
        $userAdmin->setPlainPassword('admin');
        $userAdmin->setFirstName($faker->firstName);
        $userAdmin->setLastName($faker->lastName);
        $manager->persist($userAdmin);
        $users[] = $userAdmin;

        for ($i = 0; $i < 10; $i++) {
            $userUser = new User();
            $userUser->setUsername($faker->userName);
            $userUser->setEmail('borisschapira+user'.$i.'@gmail.com');
            $userUser->setRoles(['ROLE_USER']);
            $userUser->setEnabled(true);
            $userUser->setPlainPassword('user');
            $userUser->setFirstName($faker->firstName);
            $userUser->setLastName($faker->lastName);
            $manager->persist($userUser);
            $users[] = $userUser;
        }

        /**
         * *********************
         *        Categories
         * *********************
         */

        $categoryData = [
            'Voyage' => 'voyage',
            'Multimédia' => 'multimedia',
            'Animaux' => 'animaux',
            'Mode' => 'mode',
            'Sport' => 'sport',
            'Décoration' => 'deco',
            'Culture' => 'culture',
            'Jardinage' => 'jardinage'
        ];

        $categories = [];

        foreach ($categoryData as $name => $slug) {
            $category = new Category();
            $category->setName($name);
            $category->setSlug($slug);
            $manager->persist($category);
            $categories[] = $category;
        }

        /**
         * *********************
         *        Wishes
         * *********************
         */

        foreach ($users as $user) {
            for ($i = 0; $i < 10; $i++) {
                $wish = new Wish();
                $wish->setTitle($user->getFirstName().' '. $faker->sentence($nbWords = 12, $variableNbWords = true));
                $wish->setDescription($faker->paragraph($nbSentences = 2, $variableNbSentences = true));
                $wish->setUser($user);
                $wish->setCategory($categories[rand(0, count($categories) - 1)]);
                if (rand(0, 9) % 3 == 0) {
                    $wish->setLink('https://borisschapira.com');
                }
                $manager->persist($wish);
            }
        }

        $manager->flush();
    }
}