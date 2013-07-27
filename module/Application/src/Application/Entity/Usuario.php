<?php
/**
 * @author:Gabriel Acosta;
 * @email:gabo.acosta624@gmail.com
 * 
 * 26/07/13
 */
namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;
use Application\Entity\Role;
use Zend\Crypt\Password\Bcrypt;
use Zend\Session\Container;

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

    protected $logedUser;

    public function getId()
    {
        return $this->id;
    }

    public function setPassword($password)
    {
        $bcrypt = new Bcrypt();
        $bcrypt->setSalt('vlAzj20g2e7.x8s3sm5dLbLkFOw.Qa');
        $this->password = $bcrypt->create($password);
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setRoles(Role $roles)
    {
        $this->roles = $roles;
    }

    public function getRoles()
    {
        return $this->roles;
    }

    public function setUsername($username)
    {
        $this->username = $username;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function register() {
        $sesion = new Container('usuario');
        $sesion->offsetSet('usuario',$this);
    }

    public static function getRegistered()
    {
        $sesion = new Container('usuario');
        if($sesion->offsetExists('usuario')) {
            $usuario = $sesion->offsetGet('usuario');
            return $usuario;
        }

        return false;
    }

    public function unRegister()
    {
        $sesion = new Container('usuario');
        if($sesion->offsetExists('usuario')) {
            $sesion->offsetSet('usuario',false);
        }
    }


}