<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserEmailRepository")
 */
class UserEmail
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\EmailList", inversedBy="emails")
     * @ORM\JoinColumn(nullable=false)
     */
    private $emailList;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getEmailList(): ?EmailList
    {
        return $this->emailList;
    }

    public function setEmailList(?EmailList $emailList): self
    {
        $this->emailList = $emailList;

        return $this;
    }
}
