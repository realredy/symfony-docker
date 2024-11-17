<?php

namespace App\Controller\Work;

use App\CustomHelper\work\WorkHelper;
use App\Document\Works\WorksDocument;
use Doctrine\ODM\MongoDB\DocumentManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ListWorkController extends AbstractController 
{ 
    private $status;

    public function __construct()
    {
      $this->status = false;
    }
  
   
   /** 
    * @Route("/work/listWork", name="app_listWork")
   */
   public function index(Request $request, WorkHelper $workHelpper, DocumentManager $dm): Response
   {
    
     $getLoguinStatus = intval($request->cookies->get($_ENV['SECRETNAME_KOOKIE']));
     if (!$getLoguinStatus) {
       return $this->redirectToRoute("app_home");
     }

     try {  
          if ($request->query->get("type") == 'delette' && $request->query->get("value")) {
               $_id = $request->query->get("value");
            $deleteWork = $workHelpper->deleteWork( $_id );
            $this->status = $deleteWork;
           }
           $allworks = $dm->getRepository(WorksDocument::class)->findAll();

       } catch (\Throwable $e) {
        dd($e);
      } 
 
     
       

       return $this->render('work/listWork/index.html.twig', [
         'status'       => $this->status,
         'workList'     => $allworks,
       ]);
   }
}