<?php

namespace App\Entity;

use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\PartenaireRepository")
 */
class Partenaire
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Groups({"partenaires"})
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\NotBlank(message="Le champ ne doit pas être vide")
     */
    private $rs;

    /**
     *  @Groups({"partenaires"})
     * @ORM\Column(type="integer", nullable=true)
     * @Assert\NotBlank(message="Le champ ne doit pas être vide")
     * @Assert\Length(min="8" ,max="8")
     */
    private $ninea;

    /**
     *  @Groups({"partenaires"})
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $adresse;

    /**
     *  @Groups({"partenaires"})
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $status;

    /**
     *  @Groups({"partenaires"})
     * @ORM\OneToMany(targetEntity="App\Entity\Compte", mappedBy="idpartenaire")
     */
    private $comptes;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\User", mappedBy="idpartenaire")
     */
    private $users;

    public function __construct()
    {
        $this->comptes = new ArrayCollection();
        $this->users = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRs(): ?string
    {
        return $this->rs;
    }

    public function setRs(?string $rs): self
    {
        $this->rs = $rs;

        return $this;
    }

    public function getNinea(): ?int
    {
        return $this->ninea;
    }

    public function setNinea(?int $ninea): self
    {
        $this->ninea = $ninea;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(?string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(?string $status): self
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return Collection|Compte[]
     */
    public function getComptes(): Collection
    {
        return $this->comptes;
    }

    public function addCompte(Compte $compte): self
    {
        if (!$this->comptes->contains($compte)) {
            $this->comptes[] = $compte;
            $compte->setIdpartenaire($this);
        }

        return $this;
    }

    public function removeCompte(Compte $compte): self
    {
        if ($this->comptes->contains($compte)) {
            $this->comptes->removeElement($compte);
            // set the owning side to null (unless already changed)
            if ($compte->getIdpartenaire() === $this) {
                $compte->setIdpartenaire(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users[] = $user;
            $user->setIdpartenaire($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->contains($user)) {
            $this->users->removeElement($user);
            // set the owning side to null (unless already changed)
            if ($user->getIdpartenaire() === $this) {
                $user->setIdpartenaire(null);
            }
        }

        return $this;
    }
}
