<?php

namespace App\Controller;

use App\Entity\Author;
use App\Form\AuthorformType;
use App\Repository\AuthorRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        $test = 4;
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'var' => $test
        ]);
    }

    #[Route('/new', name: 'app_new')]
    public function create(Request $request, EntityManagerInterface $em):Response
    {
      $authors = new Author;

      $form = $this->createForm(AuthorformType::class, $authors);
      $form->handleRequest($request);

      if($form->isSubmitted() && $form->isValid()) {
        $author = $form->getData();
        $em->persist($author);
        $em->flush();

      }
        return $this->render('home/create.html.twig', [
            'form' => $form
        ]);
    }

    #[Route('/edit/{id}', name: 'app_edit')]
    public function edit($id, Request $request, AuthorRepository $auhtorRepo, EntityManagerInterface $em):Response
    {
      $author = $auhtorRepo->findOneById($id);

      $form = $this->createForm(AuthorformType::class, $author);
      $form->handleRequest($request);

      if($form->isSubmitted() && $form->isValid()) {
        $author = $form->getData();
        $em->persist($author);
        $em->flush();

      }
        return $this->render('home/edit.html.twig', [
            'form' => $form
        ]);
    }
}
