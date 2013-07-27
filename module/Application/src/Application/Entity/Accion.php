<?php
/**
 * @author:Gabriel Acosta;
 * @email:gabo.acosta624@gmail.com
 *
 * 27/07/13
 */
namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;



/**
 * Clase Accion
 * @package Application\Entity
 *
 * Esta clase servira como auxiliar para le control de acceso
 * en una base de datos se dara de alta los controladores
 * y las acciones a las que tenga acceso un rol de usuario
 * y en base a eso saber si se permite o no el acceso.
 */

/**
 * @ORM\Entity
 */
class Accion
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\COlumn(type="integer")
     */
    protected $id;

    /**
     * @ORM\Column(type="string")
     */
    protected $nombre;

    /**
     * @ORM\ManyToOne(targetEntity="Controlador", inversedBy="acciones")
     * @ORM\JoinColumn(name="controlador_id", referencedColumnName="id")
     */
    protected $controlador;

    /**
     * @ORM\ManyToMany(targetEntity="Rol", mappedBy="acciones")
     **/
    private $roles;
}