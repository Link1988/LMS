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
 * Clase entidad de Usuario
 *
 * Esta clase sera la responsable de autenticar al usuario
 * y servira como base desde donde consultar su
 * perfil, sus roles y otra funcionalidad que sea necesaria
 * para el sistema
 */

/**
 * @ORM\Entity
 */
class Usuario
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
    protected $username;

    /**
     * @ORM\Column(type="string")
     */
    protected $password;

    /**
     * @ORM\ManyToMany(targetEntity="Rol", inversedBy="usuarios")
     * @ORM\JoinTable(name="usuario_roles")
     */
    protected $roles;
}