<?php

namespace App\Core\Data;


use App\Entity\User;
use App\Http\Form\AutomaticForm;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Validator\Constraints as Assert;

final class UserCrudData implements CrudDataInterface
{

    public string $username;
    private string $password;
    private ?array $roles = ['ROLE_USER'];
    public string $email = '';
    public ?bool $term = false;
    public ?\DateTimeInterface $acceptedAt;

    private UserPasswordEncoderInterface $encoder;
    private ?EntityManagerInterface $em = null;
    private ?User $entity;

    public function __construct(User $user)
    {
        $this->username = $user->getUsername();
        $this->password = $user->getPassword();
        $this->roles = $user->getRoles();
        $this->term = $user->getTerm();
        $this->acceptedAt = $user->getAcceptedAt();
        $this->email = $user->getEmail();
    }

    public function hydrate(): void
    {
        $this->entity
            ->setUsername($this->username)
            ->setPassword($this->setPasswordEncode())
            ->setRoles($this->roles)
            ->setAcceptedAt($this->acceptedAt)
            ->setTerm($this->term)
            ->setEmail($this->email);
    }

    public function getFormClass(): string
    {
        return AutomaticForm::class;
    }

    public function getEntity(): object
    {
        return $this->entity;
    }
    public function setEntityManager(EntityManagerInterface $em): self
    {
        $this->em = $em;

        return $this;
    }
    public function setPasswordEncode():string {
        return $this->encoder->encodePassword($this->entity, $this->password);
    }
}
