<?php

namespace App\DataFixtures;


use App\Entity\CategoryNews;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CategoryNewsFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $this->createCategoryNews($manager);
    }
    private function createCategoryNews($manager){
        foreach ($this->categoryData() as [$name]) {
            $category = new CategoryNews();
            $category->setTitle($name);
            $manager->persist($category);

        }
        $manager->flush();
    }
    private function categoryData(){
        return [
            ['Application features'],['Weather analyssis'],['about Politics'],
        ];
    }
}