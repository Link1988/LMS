<?php
/**
 * @author:Gabriel Acosta;
 * @email:gabo.acosta624@gmail.com
 * 
 * 26/07/13
 */
namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Clase Rol de Usuario
 *
 * Esta clase servira para identificar al usuario
 * como miembro de un grupo y de esta manera
 * determinar los derechos de acceso que cuenta
 * el usuario
 */

/**
 * @ORM\Entity
 */
class Rol
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @ORM\Column(type="string")
     */
    protected $nombre;

    /**
     * @ORM\OneToOne(targetEntity="Rol")
     * @ORM\JoinColumn(name="parent", referencedColumnName="id")
     */
    protected $parent;

    /**
     * @ORM\ManyToMany(targetEntity="Application\Entity\Usuario", mappedBy="roles")
     */
    protected $usuarios;


    /**
     * @ORM\ManyToMany(targetEntity="Controlador", inversedBy="Rol", fetch="EAGER")
     * @ORM\JoinTable(name="controladores_usuarios")
     */
    protected $controladores;

    /**
     * @ORM\ManyToMany(targetEntity="Accion", inversedBy="Rol", fetch="EAGER")
     * @ORM\JoinTable(name="acciones_usuarios")
     */
    protected $acciones;

    public function setAcciones($acciones)
    {
        $this->acciones = $acciones;
    }

    public function getAcciones()
    {
        return $this->acciones;
    }

    public function setControladores($controladores)
    {
        $this->controladores = $controladores;
    }

    public function getControladores()
    {
        return $this->controladores;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function setParent($parent)
    {
        $this->parent = $parent;
    }

    public function getParent()
    {
        return $this->parent;
    }

    public function setUsuarios($usuarios)
    {
        $this->usuarios = $usuarios;
    }

    public function getUsuarios()
    {
        return $this->usuarios;
    }

}