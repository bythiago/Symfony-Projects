<?php

namespace AppBundle\Entity;
use Symfony\Component\Validator\Constraints as Assert;
use Xiidea\EasyAuditBundle\Annotation\SubscribeDoctrineEvents;

use Doctrine\ORM\Mapping as ORM;

/**
 * Usuario
 *
 * @ORM\Table(name="USUARIO")
 * @ORM\Entity
 * @SubscribeDoctrineEvents(events = "updated, created")
 */
class Usuario
{

    /**
     * Usuario constructor.
     */
    public function __construct()
    {
        $this->setDataCadastro(date('d-m-Y'));
    }

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
     * @Assert\NotBlank()
     * @ORM\Column(name="NOME", type="string", length=40, nullable=false)
     */
    private $nome;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="NASCIMENTO", type="datetime", nullable=false)
     */
    private $nascimento;

    /**
     * @var string
     *
     * @ORM\Column(name="SEXO", type="string", length=40, nullable=false)
     */
    private $sexo;

    /**
     * @var binary
     *
     * @ORM\Column(name="CEP", type="binary", nullable=false)
     */
    private $cep;

    /**
     * @var string
     *
     * @ORM\Column(name="CPF", type="string", length=40, nullable=false)
     */
    private $cpf;

    /**
     * @var string
     *
     * @ORM\Column(name="CONTATO", type="string", length=40, nullable=false)
     */
    private $contato;

    /**
     * @var string
     *
     * @ORM\Column(name="STATUS", type="string", length=40, nullable=false)
     */
    private $status;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DATA_CADASTRO", type="datetime", nullable=false)
     */
    private $dataCadastro;

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
     * @return Usuario
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
     * Set nascimento
     *
     * @param \DateTime $nascimento
     *
     * @return Usuario
     */
    public function setNascimento($nascimento)
    {
        $this->nascimento = \DateTime::createFromFormat('d-m-Y', $nascimento);

        return $this;
    }

    /**
     * Get nascimento
     *
     * @return \DateTime
     */
    public function getNascimento()
    {
        return $this->nascimento;
    }

    /**
     * Set sexo
     *
     * @param string $sexo
     *
     * @return Usuario
     */
    public function setSexo($sexo)
    {
        $this->sexo = $sexo;

        return $this;
    }

    /**
     * Get sexo
     *
     * @return string
     */
    public function getSexo()
    {
        return $this->sexo;
    }

    /**
     * Set cep
     *
     * @param binary $cep
     *
     * @return Usuario
     */
    public function setCep($cep)
    {
        $this->cep = $cep;

        return $this;
    }

    /**
     * Get cep
     *
     * @return binary
     */
    public function getCep()
    {
        return $this->cep;
    }

    /**
     * Set cpf
     *
     * @param string $cpf
     *
     * @return Usuario
     */
    public function setCpf($cpf)
    {
        $this->cpf = $cpf;

        return $this;
    }

    /**
     * Get cpf
     *
     * @return string
     */
    public function getCpf()
    {
        return $this->cpf;
    }

    /**
     * Set contato
     *
     * @param string $contato
     *
     * @return Usuario
     */
    public function setContato($contato)
    {
        $this->contato = $contato;

        return $this;
    }

    /**
     * Get contato
     *
     * @return string
     */
    public function getContato()
    {
        return $this->contato;
    }

    /**
     * Set status
     *
     * @param string $status
     *
     * @return Usuario
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @return \DateTime
     */
    public function getDataCadastro()
    {
        return $this->dataCadastro;
    }

    /**
     * @param \DateTime $dataCadastro
     * @return Usuario
     */
    public function setDataCadastro($dataCadastro)
    {
        $this->dataCadastro = \DateTime::createFromFormat('d-m-Y', $dataCadastro);
        return $this;
    }


}
