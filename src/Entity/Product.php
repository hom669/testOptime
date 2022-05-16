<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=ProductRepository::class)
 */
class Product
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=20)
     * @Assert\NotNull(message="El Codigo No Puede Ir Vacio")
     * @Assert\Length(
     *      min = 4,
     *      max = 10,
     *      minMessage = "El codigo debe tener por minimo {{ limit }} caracteres",
     *      maxMessage = "El codigo debe tener por maximo  {{ limit }} caracteres"
     * )
     *  @Assert\Type(type={"alnum"},message="El Campo Codigo permite solo numeros y letras")
     */
    private $CodeProd;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotNull(message="El Nombre No Puede Ir Vacio")
     * @Assert\Length(
     *      min = 4,
     *      minMessage = "El Nombre debe tener por minimo {{ limit }} caracteres"
     * )
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotNull(message="La Marca No Puede Ir Vacia")
     */
    private $brand;

    /**
     * @ORM\Column(type="float")
     * @Assert\NotBlank(message="El Precio No Puede Ir Vacio")
     * @Assert\Positive(message="El Campo Precio debe ser Numerico Mayor a 0")
     */
    private $price;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private $updatedAt;

    /**
     * @ORM\ManyToOne(targetEntity=Category::class, inversedBy="category_id")
     * @ORM\JoinColumn(nullable=false)
     */
    private $categories;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $is_active;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCodeProd(): ?string
    {
        return $this->CodeProd;
    }

    public function setCodeProd(string $CodeProd): self
    {
        $this->CodeProd = $CodeProd;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getBrand(): ?string
    {
        return $this->brand;
    }

    public function setBrand(string $brand): self
    {
        $this->brand = $brand;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeImmutable $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getCategories(): ?category
    {
        return $this->categories;
    }

    public function setCategories(?category $categories): self
    {
        $this->categories = $categories;

        return $this;
    }

    public function isIsActive(): ?bool
    {
        return $this->is_active;
    }

    public function setIsActive(?bool $is_active): self
    {
        $this->is_active = $is_active;

        return $this;
    }
}
