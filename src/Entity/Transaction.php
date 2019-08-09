<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\TransactionRepository")
 */
class Transaction
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $agence;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $somme;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $frais;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $datetran;

    /**
     * @ORM\Column(type="integer")
     */
    private $code;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAgence(): ?string
    {
        return $this->agence;
    }

    public function setAgence(?string $agence): self
    {
        $this->agence = $agence;

        return $this;
    }

    public function getSomme(): ?int
    {
        return $this->somme;
    }

    public function setSomme(?int $somme): self
    {
        $this->somme = $somme;

        return $this;
    }

    public function getFrais(): ?int
    {
        return $this->frais;
    }

    public function setFrais(?int $frais): self
    {
        $this->frais = $frais;

        return $this;
    }

    public function getDatetran(): ?\DateTimeInterface
    {
        return $this->datetran;
    }

    public function setDatetran(?\DateTimeInterface $datetran): self
    {
        $this->datetran = $datetran;

        return $this;
    }

    public function getCode(): ?int
    {
        return $this->code;
    }

    public function setCode(int $code): self
    {
        $this->code = $code;

        return $this;
    }
}
