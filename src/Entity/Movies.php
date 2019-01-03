<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\File\File;
/**
 * @ORM\Entity(repositoryClass="App\Repository\MoviesRepository")
 * @Vich\Uploadable
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
    private $releaseDate;

    /**
     * @ORM\Column(type="text")
     */
    private $synopsis;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $trailerLink;

    /**
     * @ORM\Column(type="integer")
     */
    private $duration;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\People", inversedBy="moviesDirector")
     * @ORM\JoinTable(name="movies_director")
     */
    private $director;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\People", inversedBy="moviesWriter")
     * @ORM\JoinTable(name="movies_writer")
     */
    private $writer;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\People", inversedBy="moviesActor")
     * @ORM\JoinTable(name="movies_actor")
     */
    private $actor;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Genre", inversedBy="movies")
     */
    private $genre;


    /**
     * NOTE: This is not a mapped field of entity metadata, just a simple property.
     *
     * @Vich\UploadableField(mapping="movie_images", fileNameProperty="imageName", size="imageSize")
     *
     * @var File
     */
    private $imageFile;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @var string
     */
    private $imageName;

    /**
     * @ORM\Column(type="integer")
     *
     * @var integer
     */
    private $imageSize;

    /**
     * @ORM\Column(type="datetime")
     *
     * @var \DateTime
     */
    private $updatedAt;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="movies")
     */
    private $user;

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
        return $this->releaseDate;
    }

    public function setReleaseDate(\DateTimeInterface $releaseDate): self
    {
        $this->releaseDate = $releaseDate;

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
        return $this->trailerLink;
    }

    public function setTrailerLink(string $trailerLink): self
    {
        $this->trailerLink = $trailerLink;

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

    public function setImageFile(?File $image = null): void
    {
        $this->imageFile = $image;

        if (null !== $image) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTimeImmutable();
        }
    }

    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    public function setImageName(?string $imageName): void
    {
        $this->imageName = $imageName;
    }

    public function getImageName(): ?string
    {
        return $this->imageName;
    }

    public function setImageSize(?int $imageSize): void
    {
        $this->imageSize = $imageSize;
    }

    public function getImageSize(): ?int
    {
        return $this->imageSize;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

}
