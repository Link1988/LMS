<?php
/**
 * @author:Gabriel Acosta;
 * @email:gabo.acosta624@gmail.com
 * 
 * 27/07/13
 */

namespace Application\Entity;

class AccessControl
{
    protected $serviceLocator;

    protected function getEntityManager()
    {
        $em = $this->serviceLocator->get('Doctrine\ORM\EntityManager');
        return $em;
    }

    public function validateAccess(Usuario $usuario, $controlador, $accion, $serviceLocator)
    {
        $this->serviceLocator = $serviceLocator;
        $authorized = false;
        foreach($usuario->getRoles() as $rol) {
            if($rol->getNombre() == 'admin')
                $authorized = true;

            if($this->validarControlador($rol, $controlador) && $this->validarAccion($rol, $controlador, $accion))
                $authorized = true;
        }
        return $authorized;
    }

    protected function validarControlador(Rol $rol, $controlador)
    {
        $em = $this->getEntityManager();
        $dql="
            SELECT c
            FROM \Application\Entity\Controlador c
            LEFT JOIN c.roles r
            WHERE c.nombre = '$controlador' AND r.id = '".$rol->getId()."'
        ";
        $query = $em->createQuery($dql);
        $controladores = $query->execute();
        if($controlador){
            return true;
        }
        return false;
    }

    protected function validarAccion(Rol $rol, $controlador, $accion)
    {
        $em = $this->getEntityManager();
        $dql="
            SELECT a
            FROM \Application\Entity\Accion a
            LEFT JOIN a.controlador c
            LEFT JOIN a.roles r
            WHERE c.nombre = '$controlador' AND (a.nombre = '$accion' OR a.nombre='all' )AND r.id = '".$rol->getId()."'
        ";
        $query = $em->createQuery($dql);
        $accion = $query->execute();
        if($accion){
            return true;
        }
        return false;
    }
}