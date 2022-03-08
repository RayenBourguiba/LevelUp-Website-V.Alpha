<?php

namespace App\Controller;

use App\Entity\Blog;
use App\Form\Blog1Type;
use App\Repository\BlogRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/blog/contoller")
 */
class BlogContollerController extends AbstractController
{
    /**
     * @Route("/", name="blog_contoller_index", methods={"GET"})
     */
    public function index(BlogRepository $blogRepository): Response
    {
        return $this->render('blog_contoller/index.html.twig', [
            'blogs' => $blogRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="blog_contoller_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $blog = new Blog();
        $form = $this->createForm(Blog1Type::class, $blog);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($blog);
            $entityManager->flush();

            return $this->redirectToRoute('blog_contoller_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('blog_contoller/new.html.twig', [
            'blog' => $blog,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="blog_contoller_show", methods={"GET"})
     */
    public function show(Blog $blog): Response
    {
        return $this->render('blog_contoller/show.html.twig', [
            'blog' => $blog,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="blog_contoller_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Blog $blog, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(Blog1Type::class, $blog);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('blog_contoller_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('blog_contoller/edit.html.twig', [
            'blog' => $blog,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="blog_contoller_delete", methods={"POST"})
     */
    public function delete(Request $request, Blog $blog, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$blog->getId(), $request->request->get('_token'))) {
            $entityManager->remove($blog);
            $entityManager->flush();
        }

        return $this->redirectToRoute('blog_contoller_index', [], Response::HTTP_SEE_OTHER);
    }
}
