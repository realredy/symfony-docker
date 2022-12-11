<?php

namespace App\Controller\Blog;

use App\Form\Articleform;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class NewblogController extends AbstractController
{
    /**
     * @Route("/blog/newblog", name="app_newblog")
     */
    public function index(Request $request): Response 
    {
      $getLoguinStatus = intval( $request->cookies->get( $_ENV['SECRETNAME_KOOKIE'] ) ); 
     if( !$getLoguinStatus )
       {
       return $this->redirectToRoute("app_home");
        }

   
      $form = $this->createForm(Articleform::class);

        return $this->render('newblog/index.html.twig', [
            'Articleform' => $form->createView()
        ]);
    }
}