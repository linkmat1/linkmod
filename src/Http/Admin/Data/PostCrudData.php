<?php


namespace App\Http\Admin\Data;

use App\Entity\Post;
use App\Form\PostType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\VarDumper\Cloner\Data;

class PostCrudData implements CrudDataInterface
{
    public int $id;

    public string $title = "";

    public string  $slug = "";

    public string $content = "";

    public bool $isOnline = false;

    public \DateTimeInterface $createdAt;

    public \DateTimeInterface $updatedAt;

    public Post $entity;


    public function __construct()
    {
        $this->createdAt = new \DateTime();
    }
    public static function makeFromPost(Post $post): self
    {
        $data = new self();
        $data->id = $post->getId();
        $data->title =  $post->getTitle();
        $data->slug = $post->getSlug();
        $data->content = $post->getContent();
        $data->createdAt = $post->getCreatedAt();
        $data->isOnline =  $post->getIsOnline();
        $data->entity  = $post;
        return $data;
    }

    public function hydrate(Post $post, EntityManagerInterface $em): Post
    {
        $post = $post
            ->setContent($this->content)
            ->setTitle($this->title)
            ->setSlug($this->slug)
            ->setCreatedAt($this->createdAt)
            ->setIsOnline($this->isOnline)
            ->setUpdatedAt(new \DateTime());

        return $post;
    }
    /**
     * @inheritDoc
     */
    public function getEntity(): object
    {
        return $this->entity;
    }

    public function getFormClass(): string
    {
        return PostType::class;
    }
}
