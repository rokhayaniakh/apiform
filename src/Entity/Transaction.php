<?php

namespace App\Entity;

use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

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
     * @Groups({"users"})
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $agence;

    /**
     * @Groups({"users"})
     * @ORM\Column(type="integer", nullable=true)
     */
    private $somme;

    /**
     * @Groups({"users"})
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $datetran;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $code;

    /**
     * @Groups({"users"})
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $nomcomplet;

    /**
     * @Groups({"users"})
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $nomcompletben;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Assert\Length(
     *      min = 9,
     *      max = 9,
     *      minMessage = "valeur minimum 9",
     *      maxMessage = "valeur maximum 9"
     * )
     * @Groups({"users"})
     */
    private $tel;

    /**
     * @ORM\Column(type="bigint", nullable=true)
     * @Groups({"users"})
     */
    private $cni;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="transactions")
     */
    private $iduser;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Type", inversedBy="transactions")
     */
    private $idtype;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Tarifs", inversedBy="transactions")
     * @Groups({"users"})
     */
    private $frais;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @Groups({"users"})
     */
    private $dater;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Assert\Length(
     *      min = 9,
     *      max = 9,
     *      minMessage = "valeur minimum 9",
     *      maxMessage = "valeur maximum 9"
     * )
     * @Groups({"users"})
     */
    private $tele;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="transaction")
     */
    private $userr;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"users"})
     */
    private $status;

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

    public function setCode(?int $code): self
    {
        $this->code = $code;

        return $this;
    }

    public function getNomcomplet(): ?string
    {
        return $this->nomcomplet;
    }

    public function setNomcomplet(?string $nomcomplet): self
    {
        $this->nomcomplet = $nomcomplet;

        return $this;
    }

    public function getNomcompletben(): ?string
    {
        return $this->nomcompletben;
    }

    public function setNomcompletben(?string $nomcompletben): self
    {
        $this->nomcompletben = $nomcompletben;

        return $this;
    }

    public function getTel(): ?int
    {
        return $this->tel;
    }

    public function setTel(?int $tel): self
    {
        $this->tel = $tel;

        return $this;
    }

    public function getCni(): ?int
    {
        return $this->cni;
    }

    public function setCni(?int $cni): self
    {
        $this->cni = $cni;

        return $this;
    }

    public function getIduser(): ?User
    {
        return $this->iduser;
    }

    public function setIduser(?User $iduser): self
    {
        $this->iduser = $iduser;

        return $this;
    }

    public function getIdtype(): ?Type
    {
        return $this->idtype;
    }

    public function setIdtype(?Type $idtype): self
    {
        $this->idtype = $idtype;

        return $this;
    }

    public function getFrais(): ?Tarifs
    {
        return $this->frais;
    }

    public function setFrais(?Tarifs $frais): self
    {
        $this->frais = $frais;

        return $this;
    }

    public function getDater(): ?\DateTimeInterface
    {
        return $this->dater;
    }

    public function setDater(?\DateTimeInterface $dater): self
    {
        $this->dater = $dater;

        return $this;
    }

    public function getTele(): ?int
    {
        return $this->tele;
    }

    public function setTele(?int $tele): self
    {
        $this->tele = $tele;

        return $this;
    }

    public function getUserr(): ?User
    {
        return $this->userr;
    }

    public function setUserr(?User $userr): self
    {
        $this->userr = $userr;

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
}
