<?php

namespace App\Controller\Admin;

use App\Entity\PageData;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;


class PageDataCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return PageData::class;
    }

    // public function configureCrud(Crud $crud): Crud
    // {
    //     return $crud
    //         ->overrideTemplate('crud/index', '/bundles/EasyAdminBundle/index.html.twig')
    //     ;
    // }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')
            ->onlyOnIndex(),
            TextField::new('title'),
            AssociationField::new('video'),
            AssociationField::new('news'),
            AssociationField::new('photo'),
            AssociationField::new('categoryNews'),


        ];
    }

}
