<?php

namespace App\CustomHelper\work;

use App\Document\Books;
use App\Document\Works\WorksDocument;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ODM\MongoDB\DocumentManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class WorkHelper extends AbstractController
{
    private $dm;

    public function __construct(DocumentManager $dm)
    {
        $this->dm = $dm;
    }

    public function saveWork($work): string|bool
    {
        try {

            $newWork = new WorksDocument();
            $newWork->setTitle($work['title']);
            $newWork->setTools($work['tools']);
            $newWork->setImage($work['image']);
            $newWork->setLink($work['link']);
            $newWork->setBody($work['body']);

            $this->dm->persist($newWork);
            $this->dm->flush();
            return !$newWork->getId() ? false : true;

            return true;
        } catch (\Throwable $th) {
            throw new \Exception($th->getMessage());
        }
    }

    public function returnSingleWork($id):  ArrayCollection
    {
         $returnSingleWork = [];
        try {
            $getWork = $this->dm->find(WorksDocument::class, $id);
            $returnSingleWork['title'] = $getWork->getTitle();
            $returnSingleWork['tools'] = $getWork->getTools();
            $returnSingleWork['image'] = $getWork->getImage();
            $returnSingleWork['link'] = $getWork->getLink();
            $returnSingleWork['body'] = $getWork->getBody();
            $returnSingleWork['id'] = $getWork->getId();
            return new ArrayCollection( $returnSingleWork ); 
        } catch (\Throwable $th) {
            throw new \Exception($th->getMessage());
        }
    }

    public function updateWork($work):array
    { 
        try {
             $resultUpdatedWork = $this->dm->createQueryBuilder(WorksDocument::class)
             ->updateOne()
             ->field('title')->set($work['title'])
             ->field('tools')->set($work['tools'])
            ->field('image')->set($work['image'])
                ->field('link')->set($work['link'])
                ->field('body')->set($work['body'])
                ->field('_id')->equals($work['id'])
                ->getQuery()->execute();

                $result = $resultUpdatedWork->getModifiedCount() == 1 ? true : false;
                return [$work, $result];
 
        } catch (\Throwable $th) {
            throw new \Exception($th->getMessage());
        }
    }


    public function deleteWork($id): bool
    {
        
        try {
            $resultDeleteWork = $this->dm->createQueryBuilder(WorksDocument::class)
              ->findAndRemove()
              ->field('_id')->equals($id)
              ->getQuery()
              ->execute();
 
            $result = $resultDeleteWork->getId() ? true : false;
            return $result;
        } catch (\Throwable $th) {
            throw new \Exception($th->getMessage());
        }
    }
}
