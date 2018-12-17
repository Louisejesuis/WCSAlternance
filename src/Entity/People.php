<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection as Collection;
use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Entity(repositoryClass="App\Repository\PeopleRepository")
 */
class People
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
    private $firstName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $lastName;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Movies", mappedBy="director")
     */
    private $moviesDirector;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Movies", mappedBy="writer")
     */
    private $moviesWriter;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Movies", mappedBy="actor")
     */
    private $moviesActor;

    public function __construct()
    {
        $this->movies = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getfirstName(): ?string
    {
        return $this->firstName;
    }

    public function setfirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getlastName(): ?string
    {
        return $this->lastName;
    }

    public function setlastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function __toString() {
        return $this->firstName . $this->lastName;
    }

    /**
     * Get the value of moviesDirector
     */ 
    public function getmoviesDirector()
    {
        return $this->moviesDirector;
    }

    /**
     * Set the value of moviesDirector
     *
     * @return  self
     */ 
    public function setmoviesDirector($moviesDirector)
    {
        $this->moviesDirector = $moviesDirector;

        return $this;
    }

    /**
     * Get the value of moviesWriter
     */ 
    public function getmoviesWriter()
    {
        return $this->moviesWriter;
    }

    /**
     * Set the value of moviesWriter
     *
     * @return  self
     */ 
    public function setmoviesWriter($moviesWriter)
    {
        $this->moviesWriter = $moviesWriter;

        return $this;
    }

    /**
     * Get the value of moviesActor
     */ 
    public function getmoviesActor()
    {
        return $this->moviesActor;
    }

    /**
     * Set the value of moviesActor
     *
     * @return  self
     */ 
    public function setmoviesActor($moviesActor)
    {
        $this->moviesActor = $moviesActor;

        return $this;
    }
}
