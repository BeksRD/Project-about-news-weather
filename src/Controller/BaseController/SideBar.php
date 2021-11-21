<?php

namespace App\Controller\BaseController;

use App\Entity\News;
use App\Entity\PageData;
use App\Services\randomLimitArray;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SideBar extends AbstractController
{
    public function NewsSideBar(){
        $data = $this->getDoctrine()->getRepository(PageData::class)->findOneBy(['title'=>'NewsPage']);
        return $this->render('Base/SideBarNews.html.twig',[
            'data'=>$data
        ]);
    }
}