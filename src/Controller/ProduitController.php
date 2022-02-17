<?php

namespace App\Controller;

use App\Entity\Produit;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ProduitController extends AbstractController
{
    /**
     * @Route("/store", name="store")
     */
    public function index(): Response
    {
        $produits= $this->getDoctrine()->getRepository(Produit::class)->findAll();
        return $this->render('produit/index.html.twig',['$produits'=> $produits]);
    }
    /*{
        return $this->render('produit/index.html.twig', [
            'controller_name' => 'ProduitController',
        ]);
    }*/



/**
 * @Route("/produit/save")
 */
public function save() {
    $entityManager = $this->getDoctrine()->getManager();
    $produit = new produit();
    $produit->setNom('Merch 1');
    $produit->setQuantity(9);
    $produit->setPrice(25);
    $produit->setDescription('Lorem ipsum dolor sit amet. At molestiae rerum qui eaque tempora est laborum obcaecati eos voluptatem nesciunt aut atque repudiandae. Est deleniti dignissimos et eius amet ut commodi omnis aut quia maxime non rerum tenetur ad dolor laudantium est provident optio.');
    $produit->setImage('test.jpg');

    $entityManager->persist($produit);
    $entityManager->flush();
    return new Response('Produit enregisté avec id '.$produit->getId());
 }
}