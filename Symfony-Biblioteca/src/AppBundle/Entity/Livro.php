<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\PersistentCollection;

/**
 * Livro
 *
 * @ORM\Table(name="LIVRO", indexes={@ORM\Index(name="FK_REFERENCE_3", columns={"ID_AUTOR"}), @ORM\Index(name="FK_REFERENCE_2", columns={"ID_EDITORA"})})
 * @ORM\Entity
 */
class Livro
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
     * @var string
     *
     * @ORM\Column(name="NOME", type="string", length=250, nullable=false)
     */
    private $nome;

    /**
     * @var string
     *
     * @ORM\Column(name="DESCRICAO", type="string", length=400, nullable=false)
     */
    private $descricao;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="LANCAMENTO", type="datetime", nullable=false)
     */
    private $lancamento;

    /**
     * @var \Editora
     *
     * @ORM\ManyToOne(targetEntity="Editora")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ID_EDITORA", referencedColumnName="ID")
     * })
     */
    private $idEditora;

    /**
     * @var \Autor
     *
     * @ORM\ManyToOne(targetEntity="Autor", fetch="LAZY")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ID_AUTOR", referencedColumnName="ID")
     * })
     */
    private $idAutor;



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
     * Set descricao
     *
     * @param string $descricao
     *
     * @return Livro
     */
    public function setDescricao($descricao)
    {
        $this->descricao = $descricao;

        return $this;
    }

    /**
     * Get descricao
     *
     * @return string
     */
    public function getDescricao()
    {
        return $this->descricao;
    }

    /**
     * Set lancamento
     *
     * @param \DateTime $lancamento
     *
     * @return Livro
     */
    public function setLancamento($lancamento)
    {
        $this->lancamento = \DateTime::createFromFormat('d-m-Y', $lancamento);

        return $this;
    }

    /**
     * Get lancamento
     *
     * @return \DateTime
     */
    public function getLancamento()
    {
        return $this->lancamento;
    }

    /**
     * Set idEditora
     *
     * @param \AppBundle\Entity\Editora $idEditora
     *
     * @return Livro
     */
    public function setIdEditora(\AppBundle\Entity\Editora $idEditora = null)
    {
        $this->idEditora = $idEditora;

        return $this;
    }

    /**
     * Get idEditora
     *
     * @return \AppBundle\Entity\Editora
     */
    public function getIdEditora()
    {
        return $this->idEditora;
    }

    /**
     * Set idAutor
     *
     * @param \AppBundle\Entity\Autor $idAutor
     *
     * @return Livro
     */
    public function setIdAutor(\AppBundle\Entity\Autor $idAutor = null)
    {
        $this->idAutor = $idAutor;

        return $this;
    }

    /**
     * Get idAutor
     *
     * @return \AppBundle\Entity\Autor
     */
    public function getIdAutor()
    {
        return $this->idAutor;
    }

    public function hasAutor (){

        if(empty($this->idAutor)){
            return false;
        }

        return true;
    }

    public function hasAutorWithArray (){
        if(empty((array)$this->idAutor)){
            return false;
        } else {
            return true;
        }
       
    }
}
