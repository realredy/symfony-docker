<?php

namespace App\Controller;

use App\Document\Userone;
use App\Form\Loguin;
use Doctrine\ODM\MongoDB\DocumentManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="app_home")
     */
    public function index(DocumentManager $dm): Response
    {
        // $saveUser = new Userone();
        // $saveUser->setEmail('infoarte247@gmail.com');
        // $saveUser->setMipass('Elapache_3030');
        // $dm->persist($saveUser);
        // $dm->flush();

        // ? 👆 this for save the unique user
       $form = $this->createForm(Loguin::class);
        return $this->render('home/index.html.twig', [
            'Loguin' => $form->createView(),
        ]);
    }
}
