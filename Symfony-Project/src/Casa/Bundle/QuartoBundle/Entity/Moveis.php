<?php

namespace Casa\Bundle\QuartoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Moveis
 *
 * @ORM\Table(name="moveis")
 * @ORM\Entity(repositoryClass="Casa\Bundle\QuartoBundle\Repository\MoveisRepository")
 */
class Moveis
{

    public function __construct()
    {
        $this->createdAt = new \DateTime;
    }

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
     * @var string
     *
     * @ORM\Column(name="descricao", type="string", length=255)
     */
    private $descricao;

    /**
     * @var int
     *
     * @ORM\Column(name="quantidade", type="integer")
     */
    private $quantidade;


     /**
     * @var \DateTime
     * @ORM\Column(type="datetime", name="created_at")
     */
     protected $createdAt;

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
     * @return Moveis
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
     * @return Moveis
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
     * Set quantidade
     *
     * @param integer $quantidade
     *
     * @return Moveis
     */
    public function setQuantidade($quantidade)
    {
        $this->quantidade = $quantidade;

        return $this;
    }

    /**
     * Get quantidade
     *
     * @return int
     */
    public function getQuantidade()
    {
        return $this->quantidade;
    }

    /*public function setCreatedAt($createdAt){
        $this->createdAt = $createdAt;

        return $this;
    }*/

    public function getCreatedAt(){
        return $this->createdAt;
    }
}

