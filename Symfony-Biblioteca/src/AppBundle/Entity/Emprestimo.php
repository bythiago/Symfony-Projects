<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Emprestimo
 *
 * @ORM\Table(name="emprestimo", indexes={@ORM\Index(name="FK_REFERENCE_4", columns={"ID_LIVRO"})})
 * @ORM\Entity
 */
class Emprestimo
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
     * @var \DateTime
     *
     * @ORM\Column(name="DATA_EMPRESTIMO", type="datetime", nullable=false)
     */
    private $dataEmprestimo;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DATA_DEVOLUCAO", type="datetime", nullable=false)
     */
    private $dataDevolucao;

    /**
     * @var string
     *
     * @ORM\Column(name="STATUS", type="string", length=40, nullable=false)
     */
    private $status;

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
     * Set dataEmprestimo
     *
     * @param \DateTime $dataEmprestimo
     *
     * @return Emprestimo
     */
    public function setDataEmprestimo($dataEmprestimo)
    {
        $this->dataEmprestimo = \DateTime::createFromFormat('d-m-Y', $dataEmprestimo);

        return $this;
    }

    /**
     * Get dataEmprestimo
     *
     * @return \DateTime
     */
    public function getDataEmprestimo()
    {
        return $this->dataEmprestimo;
    }

    /**
     * Set dataDevolucao
     *
     * @param \DateTime $dataDevolucao
     *
     * @return Emprestimo
     */
    public function setDataDevolucao($dataDevolucao)
    {
        $this->dataDevolucao = \DateTime::createFromFormat('d-m-Y', $dataDevolucao);

        return $this;
    }

    /**
     * Get dataDevolucao
     *
     * @return \DateTime
     */
    public function getDataDevolucao()
    {
        return $this->dataDevolucao;
    }

    /**
     * Set status
     *
     * @param string $status
     *
     * @return Emprestimo
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
     * Set idLivro
     *
     * @param \AppBundle\Entity\Livro $idLivro
     *
     * @return Emprestimo
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
