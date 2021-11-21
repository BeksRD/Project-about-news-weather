<?php
namespace App\Controller\BaseController;

use App\Entity\Contact;
use App\Entity\Subscriber;
use App\Form\ContactFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use App\Form\SubscriberFormType;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping\Annotation;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

class HandleController extends AbstractController
{
    /**
     * @Route("/handle/subscriber")
     */
    public function handle_subscriber(Request $request):JsonResponse
    {

        $entityManager = $this->getDoctrine()->getManager();
        $subscriber = new Subscriber();
        $form = $this->createForm(SubscriberFormType::class,$subscriber);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
           $res = $entityManager->getRepository(Subscriber::class)->findOneBy(['email'=>$form->getData()->getEmail()]);
           if(!empty($res)){
               return new JsonResponse(['ms'=>'its already exist','type'=>'info','header'=>'You can\'t']);
           }
            $entityManager->persist($subscriber);
            $entityManager->flush();
            return new JsonResponse(['ms'=>'Successfully signed','type'=>'success','header'=>'Subscribed!']);
        }else{
            return new JsonResponse(['ms'=>'something wrong','type'=>'wrong','header'=>'You can\'t']);

        }
    }


    /**
     * @Route("/handle/contact")
     */
    public function handle_contact(Request $request): \Symfony\Component\HttpFoundation\RedirectResponse
    {
        $entityManager = $this->getDoctrine()->getManager();
        $contact = new Contact();
        $form = $this->createForm(ContactFormType::class,$contact);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $entityManager->persist($contact);
            $entityManager->flush();
        }
        return $this->redirectToRoute('app_front_home');
    }
}