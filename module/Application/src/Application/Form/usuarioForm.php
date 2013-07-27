<?php
/**
 * @author:Gabriel Acosta;
 * @email:gabo.acosta624@gmail.com
 * 
 * 26/07/13
 */

namespace Application\Form;

use Zend\Form\Annotation as Form;

/**
 * @Form\Name("usuarioForm")
 * @Form\Hydrator\("Zend\Stdlib\Hydrator\ObjectProperty")
 */

class UsuarioForm
{
    /**
     * @Form\Filter({"name":"stringTrim"})
     * @Form\Filter({"name":"StripTags"})
     * @Form\Attribute({"type":"text"})
     * @Form\Options({"label":"Nombre de Usuario: "})
     */
    public $nombreUsuario;

    /**
     * @Form\Type("Zend\Form\Element\Password")
     * @Form\Options({"label":"Contraseña: "})
     */
    public $password;

    /**
     * @Form\Type("Zend\Form\Element\Submit")
     * @Form\Attributes({"value":"submit"})
     */
   public $submit;

}

