<?php

namespace App\DataFixtures;

use App\Entity\CategoryNews;
use App\Entity\News;
use App\Entity\Photo;
use App\Entity\Product;
use App\Entity\Video;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $this->createVideo($manager);
        $this->createPhoto($manager);
        $this->createNews($manager);
        // $product = new Product();
        // $manager->persist($product);
    }
    public function createNews($manager){

        foreach ($this->newsData() as [$title,$descr,$path, $category_id] ){
            $news = new News();
            $category = $manager->getRepository(CategoryNews::class)->find($category_id);
            $news->setTitle($title);
            $news->setContent($descr);
            $news->setImg($path);
            $news->setCategory($category);
            $news->setCreatedAt();
            $manager->persist($news);
        }
        $manager->flush();
    }
    private function newsData(){
        return [
            [
                'Nemo enim ipsam voluptatem quia voluptas',
                'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolorem nulla rem dolores unde et cum illum odio, enim quis odit eveniet quaerat non libero, consequatur voluptatem harum ad veritatis necessitatibus.',
                'news_photo1.jpg',
                1,
            ],
            [
                'Nemo enim ipsam voluptatem quia voluptas',
                'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolorem nulla rem dolores unde et cum illum odio, enim quis odit eveniet quaerat non libero, consequatur voluptatem harum ad veritatis necessitatibus.',
                'news_photo1.jpg',
                2,
            ],
            [
                'Nemo enim ipsam voluptatem quia voluptas',
                'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolorem nulla rem dolores unde et cum illum odio, enim quis odit eveniet quaerat non libero, consequatur voluptatem harum ad veritatis necessitatibus.',
                'news_photo1.jpg',
                3,
            ],
            [
                'Nemo enim ipsam voluptatem quia voluptas',
                'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolorem nulla rem dolores unde et cum illum odio, enim quis odit eveniet quaerat non libero, consequatur voluptatem harum ad veritatis necessitatibus.',
                'news_photo1.jpg',
                1,
            ],
            [
                'Nemo enim ipsam voluptatem quia voluptas',
                'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolorem nulla rem dolores unde et cum illum odio, enim quis odit eveniet quaerat non libero, consequatur voluptatem harum ad veritatis necessitatibus.',
                'news_photo1.jpg',
                2,
            ],

        ];
    }
    public function createVideo($manager){
        foreach ($this->videoData() as [$title,$descr,$path, $preview] ){
            $video = new Video();
            $video->setTitle($title);
            $video->setDescription($descr);
            $video->setPath($path);
            $video->setPreview($preview);
            $video->setCreatedAt();
            $manager->persist($video);
        }
        $manager->flush();
    }
    private function videoData(){
        return [
            [
                'Nature video',
                'This cool video is show all beauty of nature',
                'video.mp4',
                'new-york.jpg',
            ],
            [
                'video1',
                'This cool video is show all beauty of nature',
                'video2.mp4',
                'new-york.jpg',
            ],
            [
                'video2',
                'This cool video is show all beauty of nature',
                'video.mp4',
                'new-york.jpg',
            ],
            [
                'video3',
                'This cool video is show all beauty of nature',
                'video2.mp4',
                'new-york.jpg',
            ],
            [
                'video4',
                'This cool video is show all beauty of nature',
                'video.mp4',
                'new-york.jpg',
            ],
            [
                'video5',
                'This cool video is show all beauty of nature',
                'video2.mp4',
                'new-york.jpg',
            ],
            [
                'video6',
                'This cool video is show all beauty of nature',
                'video.mp4',
                'new-york.jpg',
            ],
            [
                'video7',
                'This cool video is show all beauty of nature',
                'video2.mp4',
                'new-york.jpg',
            ],
            [
                'video8',
                'This cool video is show all beauty of nature',
                'video.mp4',
                'new-york.jpg',
            ],
            [
                'video9',
                'This cool video is show all beauty of nature',
                'video2.mp4',
                'new-york.jpg',
            ],
        ];
    }
    public function createPhoto($manager){
        foreach ($this->photoData() as [$title,$descr,$path] ){
            $photo = new Photo();
            $photo->setTitle($title);
            $photo->setContent($descr);
            $photo->setPath($path);
            $manager->persist($photo);
        }
        $manager->flush();
    }
    private function photoData(){
        return [
            [
                'Beautiful photo',
                'This cool photo is show all beauty of nature',
                'awesome_photo1.jpg',
            ],
            [
                'Beautiful photo',
                'This cool photo is show all beauty of nature',
                'awesome_photo2.jpg',
            ],
            [
                'Beautiful photo',
                'This cool photo is show all beauty of nature',
                'awesome_photo3.jpg',
            ],
            [
                'Beautiful photo',
                'This cool photo is show all beauty of nature',
                'awesome_photo4.jpg',
            ],
            [
                'Beautiful photo',
                'This cool photo is show all beauty of nature',
                'awesome_photo5.jpg',
            ],
            [
                'Beautiful photo',
                'This cool photo is show all beauty of nature',
                'awesome_photo6.jpg',
            ],
            [
                'Beautiful photo',
                'This cool photo is show all beauty of nature',
                'awesome_photo7.jpg',
            ],
            [
                'Beautiful photo',
                'This cool photo is show all beauty of nature',
                'awesome_photo8.jpg',
            ],
            [
                'Beautiful photo',
                'This cool photo is show all beauty of nature',
                'awesome_photo9.jpg',
            ],
            [
                'Beautiful photo',
                'This cool photo is show all beauty of nature',
                'LA.jpg',
            ],
        ];
    }
    public function getDependencies(): array
    {
        return [
            CategoryNewsFixtures::class
        ];
    }

}
