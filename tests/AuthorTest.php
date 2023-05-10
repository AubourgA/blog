<?php

namespace App\Tests;

use App\Entity\Author;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class AuthorTest extends KernelTestCase
{

    private function getEntity() : Author
    {
        return new Author;
    }

    public function testEntityisValid(): void
    {
        self::bootKernel();
        //recuperer le container
        $container = static::getContainer();


        $author = $this->getEntity();
        $author->setName('adrien');

        //count error
        $errors = $container->get('validator')->validate($author);

        $this->assertCount(0, $errors);
    }

    public function testEntityisNotValid(): void
    {
        self::bootKernel();
        //recuperer le container
        $container = static::getContainer();


        $author = $this->getEntity();
        $author->setName('');

        //count error
        $errors = $container->get('validator')->validate($author);

        $this->assertCount(1, $errors);
    }
   

    public function testAuthorIsRecorded()
    {
        self::bootKernel();
        //recuperer le container
        $container = static::getContainer();

        $author = $container->get('doctrine.orm.default_entity_manager')->find(Author::class, 1);
       
        $this->assertEquals('Adrien', $author->getName(), 'ce n est pas egual a l entree');
    }
}
