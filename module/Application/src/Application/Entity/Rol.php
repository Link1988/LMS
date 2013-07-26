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
     * @ORM\JoinColumn(name="rol_id", referencedColumnName="id")
     */
    protected $parent;

    /**
     * @ORM\ManyToMany(targetEntity="Usuario", mappedBy="roles")
     */
    protected $usuarios;
}