<?php

namespace App\DataFixtures;

use App\Entity\Product;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Generator;

class AppFixtures extends Fixture
{
    // private Generator $faker;
    // public function __construct()
    // {
    //     $this->faker = Factory::create('fr _FR');
    // }
    public function load(ObjectManager $manager): void
    {

        // for ($i = 1; $i <= 49, $i++) {
        //     $product = new Product(); 
        //     $product ->setName($this->faker->word())
        //         ->setPrice(mt_rand(0, 100));

        //     $manager->persist($product);

        // }
        $user = new User();
        $user->setUsername('Laurent')
            ->setPassword('1234');

        $manager->persist($user);

        $manager->flush();
    }
}
