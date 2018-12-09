<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\GenreRepository")
 */
class Genre
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
     * @ORM\ManyToMany(targetEntity="App\Entity\Movies", mappedBy="genre")
     */
    private $movies;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Genre", inversedBy="genres")
     */
    private $genre;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Genre", mappedBy="genre")
     */
    private $genres;

    public function __construct()
    {
        $this->movies = new ArrayCollection();
        $this->genre = new ArrayCollection();
        $this->genres = new ArrayCollection();
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

    /**
     * @return Collection|Movies[]
     */
    public function getMovies(): Collection
    {
        return $this->movies;
    }

    public function addMovie(Movies $movie): self
    {
        if (!$this->movies->contains($movie)) {
            $this->movies[] = $movie;
            $movie->addGenre($this);
        }

        return $this;
    }

    public function removeMovie(Movies $movie): self
    {
        if ($this->movies->contains($movie)) {
            $this->movies->removeElement($movie);
            $movie->removeGenre($this);
        }

        return $this;
    }

    /**
     * @return Collection|self[]
     */
    public function getGenre(): Collection
    {
        return $this->genre;
    }

    public function addGenre(self $genre): self
    {
        if (!$this->genre->contains($genre)) {
            $this->genre[] = $genre;
        }

        return $this;
    }

    public function removeGenre(self $genre): self
    {
        if ($this->genre->contains($genre)) {
            $this->genre->removeElement($genre);
        }

        return $this;
    }

    /**
     * @return Collection|self[]
     */
    public function getGenres(): Collection
    {
        return $this->genres;
    }
}
