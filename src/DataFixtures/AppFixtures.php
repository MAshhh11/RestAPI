<?php

namespace App\DataFixtures;

use App\Entity\Customer;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create();

        for ($i = 0; $i < 50; ++$i) {
            $customer = new Customer();
            $customer->setFirstname($faker->firstname);
            $customer->setLastname($faker->lastname);
            $customer->setEmail($faker->email);
            $customer->setPhoneNumber($faker->phoneNumber);
            $manager->persist($customer);
        }
        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
}
