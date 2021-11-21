<?php

namespace App\Entity;

use App\Repository\PageDataRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PageDataRepository::class)
 */
class PageData
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\ManyToMany(targetEntity=Video::class)
     */
    private $video;

    /**
     * @ORM\ManyToMany(targetEntity=News::class)
     */
    private $news;

    /**
     * @ORM\ManyToMany(targetEntity=Photo::class)
     */
    private $photo;

    /**
     * @ORM\ManyToMany(targetEntity=CategoryNews::class)
     */
    private $categoryNews;

    public function __construct()
    {
        $this->video = new ArrayCollection();
        $this->news = new ArrayCollection();
        $this->photo = new ArrayCollection();
        $this->categoryNews = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return Collection|Video[]
     */
    public function getVideo(): Collection
    {
        return $this->video;
    }

    public function addVideo(Video $video): self
    {
        if (!$this->video->contains($video)) {
            $this->video[] = $video;
        }

        return $this;
    }

    public function removeVideo(Video $video): self
    {
        $this->video->removeElement($video);

        return $this;
    }

    /**
     * @return Collection|News[]
     */
    public function getNews(): Collection
    {
        return $this->news;
    }

    public function addNews(News $news): self
    {
        if (!$this->news->contains($news)) {
            $this->news[] = $news;
        }

        return $this;
    }

    public function removeNews(News $news): self
    {
        $this->news->removeElement($news);

        return $this;
    }

    /**
     * @return Collection|Photo[]
     */
    public function getPhoto(): Collection
    {
        return $this->photo;
    }

    public function addPhoto(Photo $photo): self
    {
        if (!$this->photo->contains($photo)) {
            $this->photo[] = $photo;
        }

        return $this;
    }

    public function removePhoto(Photo $photo): self
    {
        $this->photo->removeElement($photo);

        return $this;
    }

    /**
     * @return Collection|CategoryNews[]
     */
    public function getCategoryNews(): Collection
    {
        return $this->categoryNews;
    }

    public function addCategoryNews(CategoryNews $categoryNews): self
    {
        if (!$this->categoryNews->contains($categoryNews)) {
            $this->categoryNews[] = $categoryNews;
        }

        return $this;
    }

    public function removeCategoryNews(CategoryNews $categoryNews): self
    {
        $this->categoryNews->removeElement($categoryNews);

        return $this;
    }
}
