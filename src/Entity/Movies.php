<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MoviesRepository")
 */
class Movies
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
    private $name;

    /**
     * @ORM\Column(type="date")
     */
    private $release_date;

    /**
     * @ORM\Column(type="text")
     */
    private $synopsis;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $trailer_link;

    /**
     * @ORM\Column(type="integer")
     */
    private $duration;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\People", inversedBy="movies_director")
     * @ORM\JoinTable(name="movies_director")
     */
    private $director;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\People", inversedBy="movies_writer")
     * @ORM\JoinTable(name="movies_writer")
     */
    private $writer;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\People", inversedBy="movies_actor")
     * @ORM\JoinTable(name="movies_actor")
     */
    private $actor;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Genre", inversedBy="movies")
     */
    private $genre;

    public function __construct()
    {
        $this->director = new ArrayCollection();
        $this->writer = new ArrayCollection();
        $this->actor = new ArrayCollection();
        $this->genre = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getReleaseDate(): ?\DateTimeInterface
    {
        return $this->release_date;
    }

    public function setReleaseDate(\DateTimeInterface $release_date): self
    {
        $this->release_date = $release_date;

        return $this;
    }

    public function getSynopsis(): ?string
    {
        return $this->synopsis;
    }

    public function setSynopsis(string $synopsis): self
    {
        $this->synopsis = $synopsis;

        return $this;
    }

    public function getTrailerLink(): ?string
    {
        return $this->trailer_link;
    }

    public function setTrailerLink(string $trailer_link): self
    {
        $this->trailer_link = $trailer_link;

        return $this;
    }

    public function getDuration(): ?int
    {
        return $this->duration;
    }

    public function setDuration(int $duration): self
    {
        $this->duration = $duration;

        return $this;
    }

    /**
     * @return Collection|People[]
     */
    public function getDirector(): Collection
    {
        return $this->director;
    }

    public function addDirector(People $director): self
    {
        if (!$this->director->contains($director)) {
            $this->director[] = $director;
        }

        return $this;
    }

    public function removeDirector(People $director): self
    {
        if ($this->director->contains($director)) {
            $this->director->removeElement($director);
        }

        return $this;
    }

    /**
     * @return Collection|People[]
     */
    public function getWriter(): Collection
    {
        return $this->writer;
    }

    public function addWriter(People $writer): self
    {
        if (!$this->writer->contains($writer)) {
            $this->writer[] = $writer;
        }

        return $this;
    }

    public function removeWriter(People $writer): self
    {
        if ($this->writer->contains($writer)) {
            $this->writer->removeElement($writer);
        }

        return $this;
    }

    /**
     * @return Collection|People[]
     */
    public function getActor(): Collection
    {
        return $this->actor;
    }

    public function addActor(People $actor): self
    {
        if (!$this->actor->contains($actor)) {
            $this->actor[] = $actor;
        }

        return $this;
    }

    public function removeActor(People $actor): self
    {
        if ($this->actor->contains($actor)) {
            $this->actor->removeElement($actor);
        }

        return $this;
    }

    /**
     * @return Collection|Genre[]
     */
    public function getGenre(): Collection
    {
        return $this->genre;
    }

    public function addGenre(Genre $genre): self
    {
        if (!$this->genre->contains($genre)) {
            $this->genre[] = $genre;
        }

        return $this;
    }

    public function removeGenre(Genre $genre): self
    {
        if ($this->genre->contains($genre)) {
            $this->genre->removeElement($genre);
        }

        return $this;
    }
}
