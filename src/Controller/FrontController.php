<?php

namespace App\Controller;

use App\Entity\CategoryNews;
use App\Entity\News;
use App\Entity\PageData;
use App\Entity\Subscriber;
use App\Entity\Photo;
use App\Entity\Video;
use App\Form\ContactFormType;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Services\randomLimitArray;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;


class FrontController extends AbstractController
{
    #[Route('/home')]
    public function home(): Response
    {
        $timestamp = strtotime('-1 day');
        $days = array();
        for ($i = 0; $i < 7; $i++) {
            $days[] = strftime('%w', $timestamp);
            $timestamp = strtotime('+1 day', $timestamp);
        }
        $data = $this->getDoctrine()->getRepository(PageData::class)->findOneBy(['title'=>'HomePage']);
        return $this->render('front/home.html.twig', [
            'data'=>$data,
            'days'=>$days,
        ]);
    }
    #[Route('/news')]
    public function news(PaginatorInterface $paginator, Request $request, ): Response
    {
        $data = $this->getDoctrine()->getRepository(PageData::class)->findOneBy(['title'=>'NewsPage']);
        $news = $data->getNews();
        foreach($news as $new){
            $getNews[] = $new;
        }
        $pagination = $paginator->paginate($getNews,$request->query->getInt('page', 1),3);
        return $this->render('front/news.html.twig',[
            'pagination' => $pagination,
            'data'=>$data,
        ]);
    }

    #[Route('/life/camera')]
    public function live_cameras(PaginatorInterface $paginator, Request $request,): Response
    {
        $data = $this->getDoctrine()->getRepository(PageData::class)->findOneBy(['title'=>'LifeCameras']);
        foreach($data->getVideo() as $video){
            $videos[] = $video;
        }
        $pagination = $paginator->paginate($videos,$request->query->getInt('page', 1),8);
        return $this->render('front/life-cameras.html.twig',[
            'pagination' => $pagination,
        ]);
    }
    #[Route('/photos')]
    public function photos(PaginatorInterface $paginator, Request $request,): Response
    {
        $data = $this->getDoctrine()->getRepository(PageData::class)->findOneBy(['title'=>'Photos']);
        foreach($data->getPhoto() as $photo){
            $photos[] = $photo;
        }
        $pagination = $paginator->paginate($photos,$request->query->getInt('page', 1),10);
        return $this->render('front/photos.html.twig',[
            'pagination' => $pagination,
        ]);
    }
    #[Route('/contacts')]
    public function contacts(): Response
    {
        $form = $this->createForm(ContactFormType::class,null,['action'=>'/handle/contact']);
        return $this->render('front/contacts.html.twig',['form'=>$form->createView()]);
    }

    #[Route('/single/news/{id}')]
    public function SingleNews($id){
        $new = $this->getDoctrine()->getRepository(News::class)->find($id);
        return $this->render('front/SingleNews.html.twig',['news'=>$new]);
    }
}
