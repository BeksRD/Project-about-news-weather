<?php

namespace App\Controller\Admin;

use App\Entity\LifeCameras;
use App\Entity\News;
use App\Entity\PageData;
use App\Entity\Photo;
use App\Entity\Video;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        $routeBuilder = $this->get(AdminUrlGenerator::class);

        return $this->redirect($routeBuilder->setController(PageDataCrudController::class)->generateUrl());
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Weather')
            ->renderSidebarMinimized();
    }
    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToCrud('Videos',"fa fa-video-camera",Video::class);
        yield MenuItem::linkToCrud('News',"fa fa-newspaper-o",News::class);
        yield MenuItem::linkToCrud('Photos',"fa fa-camera",Photo::class);


        // yield MenuItem::linkToCrud('The Label', 'fas fa-list', EntityClass::class);
    }
}
