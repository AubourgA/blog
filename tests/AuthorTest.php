<?php

namespace App\Tests;

use App\Entity\Author;
use App\Entity\Comment;
use PHPUnit\Framework\TestCase;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class AuthorTest extends KernelTestCase
{
    
    public function getEntity(): Author
    {

        return (new Author);        ;
    }

    
    public function assertHasErrors(Author $author, int $number, string $message)
    {
        self::bootKernel();
        $error = static::getContainer()->get('validator')->validate($author);
        $this->assertCount($number, $error, $message);
    }

    /** @test */
    public function nameAuthorIsOnlyString(): void
    {
      
        $this->assertHasErrors($this->getEntity()->setName("jean"),0, 'nameAuthor has not only string');
      

    }

        /** @test */
        public function nameAuthorIsNotOnlyString(): void
        {
          
            $this->assertHasErrors($this->getEntity()->setName(""),1, 'nameAuthor is not only string but blanck');
    
        }

               /** @test */
            //    public function nameAuthorIsBlanck(): void
            //    {
                 
            //       $author = (new Author())
            //                    ->setName(" ")
            //                    ->addComment( new Comment);
                               
            //        self::bootKernel();
            //       $container = static::getContainer();
            //        $error = $container->get('validator')->validate($author);
           
            //        $this->assertCount(1, $error, "nameAuthoris not blank");
           
            //    }
               
                   /** @test */
                //    public function nameAuthorIsNotNull(): void
                //    {
                     
                //       $author = (new Author())
                //                    ->setName(" ")
                //                    ->addComment( new Comment);
                                   
                //        self::bootKernel();
                //       $container = static::getContainer();
                //        $error = $container->get('validator')->validate($author);
               
                //        $this->assertCount(1, $error);
               
                //    }
    }
