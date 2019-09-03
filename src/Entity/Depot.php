<?php

namespace App\Entity;

use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\DepotRepository")
 */
class Depot
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"depot"})
     */
    private $id;

    /**
     * @ORM\Column(type="integer", nullable=true)*
     * @Groups({"depot"})
     */
    private $montant;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @Groups({"depot"})
     */
    private $date;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Compte", inversedBy="depots")
     * @Groups({"depot"})
     */
    private $idcompte;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMontant(): ?int
    {
        return $this->montant;
    }

    public function setMontant(?int $montant): self
    {
        $this->montant = $montant;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(?\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getIdcompte(): ?Compte
    {
        return $this->idcompte;
    }

    public function setIdcompte(?Compte $idcompte): self
    {
        $this->idcompte = $idcompte;

        return $this;
    }
}
