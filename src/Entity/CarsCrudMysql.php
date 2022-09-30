<?php

namespace App\Entity;

use App\Repository\CarsCrudMysqlRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CarsCrudMysqlRepository::class)
 * @Orm\Table(name="cars")
 */
class CarsCrudMysql
{
    protected $table = 'cars';
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=200, nullable=true)
     */
    private $Name;

    /**
     * @ORM\Column(type="string", length=200, nullable=true)
     */
    private $Model;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $Year;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->Name;
    }

    public function setName(?string $Name): self
    {
        $this->Name = $Name;

        return $this;
    }

    public function getModel(): ?string
    {
        return $this->Model;
    }

    public function setModel(?string $Model): self
    {
        $this->Model = $Model;

        return $this;
    }

    public function getYear(): ?int
    {
        return $this->Year;
    }

    public function setYear(?int $Year): self
    {
        $this->Year = $Year;

        return $this;
    }
}
