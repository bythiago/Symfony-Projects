<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * LivroCategoria
 *
 * @ORM\Table(name="livro_categoria", indexes={@ORM\Index(name="FK_REFERENCE_7", columns={"ID_CATEGORIA"}), @ORM\Index(name="FK_REFERENCE_8", columns={"ID_LIVRO"})})
 * @ORM\Entity
 */
class LivroCategoria
{
    /**
     * @var integer
     *
     * @ORM\Column(name="ID", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \Categoria
     *
     * @ORM\ManyToOne(targetEntity="Categoria")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ID_CATEGORIA", referencedColumnName="ID")
     * })
     */
    private $idCategoria;

    /**
     * @var \Livro
     *
     * @ORM\ManyToOne(targetEntity="Livro")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ID_LIVRO", referencedColumnName="ID")
     * })
     */
    private $idLivro;



    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set idCategoria
     *
     * @param \AppBundle\Entity\Categoria $idCategoria
     *
     * @return LivroCategoria
     */
    public function setIdCategoria(\AppBundle\Entity\Categoria $idCategoria = null)
    {
        $this->idCategoria = $idCategoria;

        return $this;
    }

    /**
     * Get idCategoria
     *
     * @return \AppBundle\Entity\Categoria
     */
    public function getIdCategoria()
    {
        return $this->idCategoria;
    }

    /**
     * Set idLivro
     *
     * @param \AppBundle\Entity\Livro $idLivro
     *
     * @return LivroCategoria
     */
    public function setIdLivro(\AppBundle\Entity\Livro $idLivro = null)
    {
        $this->idLivro = $idLivro;

        return $this;
    }

    /**
     * Get idLivro
     *
     * @return \AppBundle\Entity\Livro
     */
    public function getIdLivro()
    {
        return $this->idLivro;
    }
}
