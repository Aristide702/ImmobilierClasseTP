<?php

namespace App\Entity;

use App\Repository\AgenceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AgenceRepository::class)]
class Agence
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    #[Assert\NotBlank(message:'ce champ ne peut pas être vide') ]
    #[Assert\Type(
        type: 'integer',
        message: 'The value {{ value }} is not a valid {{ type }}.',
    )]
    private ?float $numeroAgence = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message:'ce champ ne peut pas être vide') ]
    private ?string $adresse = null;

    /**
     * @var Collection<int, Article>
     */
    #[ORM\OneToMany(targetEntity: Article::class, mappedBy: 'agence')]
    private Collection $articles;

    /**
     * @var Collection<int, Client>
     */
    #[ORM\OneToMany(targetEntity: Client::class, mappedBy: 'agence')]
    private Collection $client;

    #[ORM\ManyToOne(inversedBy: 'agences')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Directeur $directeur = null;

    #[ORM\ManyToOne(inversedBy: 'agences')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Siege $siege = null;

    public function __construct()
    {
        $this->articles = new ArrayCollection();
        $this->client = new ArrayCollection();
    }

    
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumeroAgence(): ?float
    {
        return $this->numeroAgence;
    }

    public function setNumeroAgence(float $numeroAgence): static
    {
        $this->numeroAgence = $numeroAgence;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): static
    {
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * @return Collection<int, Article>
     */
    public function getArticles(): Collection
    {
        return $this->articles;
    }

    public function addArticle(Article $article): static
    {
        if (!$this->articles->contains($article)) {
            $this->articles->add($article);
            $article->setAgence($this);
        }

        return $this;
    }

    public function removeArticle(Article $article): static
    {
        if ($this->articles->removeElement($article)) {
            // set the owning side to null (unless already changed)
            if ($article->getAgence() === $this) {
                $article->setAgence(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Client>
     */
    public function getClient(): Collection
    {
        return $this->client;
    }

    public function addClient(Client $client): static
    {
        if (!$this->client->contains($client)) {
            $this->client->add($client);
            $client->setAgence($this);
        }

        return $this;
    }

    public function removeClient(Client $client): static
    {
        if ($this->client->removeElement($client)) {
            // set the owning side to null (unless already changed)
            if ($client->getAgence() === $this) {
                $client->setAgence(null);
            }
        }

        return $this;
    }

    public function getDirecteur(): ?Directeur
    {
        return $this->directeur;
    }

    public function setDirecteur(?Directeur $directeur): static
    {
        $this->directeur = $directeur;

        return $this;
    }

    public function getSiege(): ?Siege
    {
        return $this->siege;
    }

    public function setSiege(?Siege $siege): static
    {
        $this->siege = $siege;

        return $this;
    }

    public function __toString()
    {
        return $this->numeroAgence();
    }

    }
