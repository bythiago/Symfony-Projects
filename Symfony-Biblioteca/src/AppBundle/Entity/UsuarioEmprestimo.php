<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UsuarioEmprestimo
 *
 * @ORM\Table(name="usuario_emprestimo", indexes={@ORM\Index(name="FK_REFERENCE_5", columns={"ID_USUARIO"}), @ORM\Index(name="FK_REFERENCE_6", columns={"ID_EMPRESTIMO"})})
 * @ORM\Entity
 */
class UsuarioEmprestimo
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
     * @var \Usuario
     *
     * @ORM\ManyToOne(targetEntity="Usuario")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ID_USUARIO", referencedColumnName="ID")
     * })
     */
    private $idUsuario;

    /**
     * @var \Emprestimo
     *
     * @ORM\ManyToOne(targetEntity="Emprestimo")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ID_EMPRESTIMO", referencedColumnName="ID")
     * })
     */
    private $idEmprestimo;



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
     * Set idUsuario
     *
     * @param \AppBundle\Entity\Usuario $idUsuario
     *
     * @return UsuarioEmprestimo
     */
    public function setIdUsuario(\AppBundle\Entity\Usuario $idUsuario = null)
    {
        $this->idUsuario = $idUsuario;

        return $this;
    }

    /**
     * Get idUsuario
     *
     * @return \AppBundle\Entity\Usuario
     */
    public function getIdUsuario()
    {
        return $this->idUsuario;
    }

    /**
     * Set idEmprestimo
     *
     * @param \AppBundle\Entity\Emprestimo $idEmprestimo
     *
     * @return UsuarioEmprestimo
     */
    public function setIdEmprestimo(\AppBundle\Entity\Emprestimo $idEmprestimo = null)
    {
        $this->idEmprestimo = $idEmprestimo;

        return $this;
    }

    /**
     * Get idEmprestimo
     *
     * @return \AppBundle\Entity\Emprestimo
     */
    public function getIdEmprestimo()
    {
        return $this->idEmprestimo;
    }
}
