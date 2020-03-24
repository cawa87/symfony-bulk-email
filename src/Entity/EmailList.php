<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EmailListRepository")
 */
class EmailList
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
    private $title;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\UserEmail", mappedBy="emailList")
     */
    private $emails;

    public function __construct()
    {
        $this->emails = new ArrayCollection();
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
     * @return Collection|UserEmail[]
     */
    public function getEmails(): Collection
    {
        return $this->emails;
    }

    public function addEmail(UserEmail $email): self
    {
        if (!$this->emails->contains($email)) {
            $this->emails[] = $email;
            $email->setEmailList($this);
        }

        return $this;
    }

    public function removeEmail(UserEmail $email): self
    {
        if ($this->emails->contains($email)) {
            $this->emails->removeElement($email);
            // set the owning side to null (unless already changed)
            if ($email->getEmailList() === $this) {
                $email->setEmailList(null);
            }
        }

        return $this;
    }
}
