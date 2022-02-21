<?php
namespace App\Controller\BaseController;

use App\Entity\Subscriber;
use App\Form\SubscriberFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\Mapping\Annotation;
use Symfony\Component\Routing\Annotation\Route;

class Footer extends AbstractController
{
    
    public function show(Request $request):Response{

        $form = $this->createForm(SubscriberFormType::class,null,['action'=>'/handle/subscriber']);
        
        return $this->render('Base/footer.html.twig',['form'=>$form->createView()]);
    }
}