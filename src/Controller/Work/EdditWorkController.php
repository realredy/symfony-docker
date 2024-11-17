<?php

namespace App\Controller\Work;
 
use App\CustomHelper\work\WorkHelper;
use App\Document\Works\WorksDocument;
use App\Feching\Fetchdata;
use App\Form\Work\WorkType;
use Doctrine\ODM\MongoDB\DocumentManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class EdditWorkController extends AbstractController 
{ 
    private $status;

    public function __construct()
    {
      $this->status = false;
    }
  
   
   /** 
    * @Route("/work/edditWork", name="app_edditWork")
   */
   public function index(Request $request, WorkHelper $workHelpper, Fetchdata $fetchdata, DocumentManager $dm): Response
   {
    
     $getLoguinStatus = intval($request->cookies->get($_ENV['SECRETNAME_KOOKIE']));
     if (!$getLoguinStatus) {
       return $this->redirectToRoute("app_home");
     }

     try {
      
        if( $request->query->get("type") == 'eddit' && $request->query->get("value")){

           $getWorksForEddit = $workHelpper->returnSingleWork($request->query->get("value"))->toArray();  
            if ($getWorksForEddit) {
           $form = $this->createForm(WorkType::class, null ,['attr' => $getWorksForEddit ]);
            }
           }

           if ($request->query->get("type") == 'save' && "array" == getType($request->request->get("work"))) {
            [$work , $result ] = $workHelpper->updateWork($request->request->get("work"));
            $this->status = $result;
            $form = $this->createForm(WorkType::class, null ,['attr' => $work]);
           } 
           
       } catch (\Throwable $e) {
        dd($e);
      } 

      $imageBank = $fetchdata->fetchGitHubInformation();
     
    

       return $this->render('work/edditWork/index.html.twig', [
         'status'       => $this->status,
         'mediaElement' => $imageBank,
         'edditWorkForm'   => $form->createView(),
       ]);
   }
}