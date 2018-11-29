<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CommentaireRepository")
 */
class Commentaire
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $auteur;

    /**
     * @ORM\Column(type="datetime")
     */
    private $cresated_at;

    /**
     * @ORM\Column(type="datetime")
     */
    private $updated_at;

    /**
     * @ORM\Column(type="text")
     */
    private $contenu;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $appartient;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Article", inversedBy="commentaires")
     */
    private $fk_article;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAuteur(): ?string
    {
        return $this->auteur;
    }

    public function setAuteur(?string $auteur): self
    {
        $this->auteur = $auteur;

        return $this;
    }

    public function getCresatedAt(): ?\DateTimeInterface
    {
        return $this->cresated_at;
    }

    public function setCresatedAt(\DateTimeInterface $cresated_at): self
    {
        $this->cresated_at = $cresated_at;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(\DateTimeInterface $updated_at): self
    {
        $this->updated_at = $updated_at;

        return $this;
    }

    public function getContenu(): ?string
    {
        return $this->contenu;
    }

    public function setContenu(string $contenu): self
    {
        $this->contenu = $contenu;

        return $this;
    }

    public function getAppartient(): ?string
    {
        return $this->appartient;
    }

    public function setAppartient(string $appartient): self
    {
        $this->appartient = $appartient;

        return $this;
    }

    public function getFkArticle(): ?Article
    {
        return $this->fk_article;
    }

    public function setFkArticle(?Article $fk_article): self
    {
        $this->fk_article = $fk_article;

        return $this;
    }
}
