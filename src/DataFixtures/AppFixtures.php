<?php

namespace App\DataFixtures;

use App\Entity\Author;
use Faker\Factory;
use App\Entity\Comment;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
   
        $faker = Factory::create();

        for($i=0; $i<15; $i++) {
            $author= new Author;
            $author->setName($faker->firstName);
            $manager->persist($author);
        }

        for($i=0; $i<10; $i++) {
            $comment = new Comment;
           $comment->setDescription($faker->realText(150,2));
            $comment->setAuthor($author->getId());
            $manager->persist($comment);
        }

        $manager->flush();
    }
}
