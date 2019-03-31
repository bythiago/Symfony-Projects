<?php

namespace BibliotecaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Livro
 *
 * @ORM\Table(name="livro")
 * @ORM\Entity(repositoryClass="BibliotecaBundle\Repository\LivroRepository")
 */
class Livro
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nome", type="string", length=255)
     */
    private $nome;

    /**
     * @var Editora
     * 
     * @ORM\ManyToOne(targetEntity="Editora")
     * @ORM\JoinColumn(name="editora", referencedColumnName="id") 
     */
    private $editora;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nome
     *
     * @param string $nome
     *
     * @return Livro
     */
    public function setNome($nome)
    {
        $this->nome = $nome;

        return $this;
    }

    /**
     * Get nome
     *
     * @return string
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * Set editora
     *
     * @param \stdClass $editora
     *
     * @return Livro
     */
    public function setEditora($editora)
    {
        $this->editora = $editora;

        return $this;
    }

    /**
     * Get editora
     *
     * @return \stdClass
     */
    public function getEditora()
    {
        return $this->editora;
    }
}

