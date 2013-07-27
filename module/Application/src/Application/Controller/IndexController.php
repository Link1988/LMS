<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2013 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\Form\Annotation\AnnotationBuilder;
use Zend\View\Model\ViewModel;
use Zend\Crypt\Password\Bcrypt;
use Application\Entity\Usuario;
use Zend\Session\Container;

use Application\Form\UsuarioForm;

class IndexController extends AbstractActionController
{
    protected $form;

    public function indexAction()
    {


    }

    public function signinAction(){
        $form = $this->getForm();

        return new ViewModel(
            array(
                "form" => $form,
                "mensajes" => $this->flashMessenger()->getMessages()
            )
        );
    }

    public function loginAction()
    {

        $form = $this->getForm();
        $redirect = 'home';

        $request = $this->getRequest();

        if($request->isPost()) {
            $form->setData($request->getPost());

            if($form->isValid()) {
                $em = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
                $bcrypt = new Bcrypt();
                $bcrypt->setSalt('vlAzj20g2e7.x8s3sm5dLbLkFOw.Qa');
                $password = $bcrypt->create($request->getPost('password'));
                $username = $request->getPost('nombreUsuario');

                $detalles = array(
                    'username' => $username,
                    'password' => $password
                );
                $usuario = $em->getRepository('Application\Entity\Usuario')->findOneBy($detalles);

                if($usuario->getId()) {
                    $usuario->register();
                    return $this->redirect()->toRoute('home');
                }

            }
        }
        return array();
    }

    public function crearAction()
    {
        /*
        $em = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        $usuario = new Usuario();
        $usuario->setUsername('gabo');
        $usuario->setPassword('test');
        $em->persist($usuario);
        $em->flush();*/
        $usuario = Usuario::getRegistered();
        return array(
            'test' => $usuario
        );
    }

    public function logoutAction()
    {
        $usuario = Usuario::getRegistered();
        $usuario->unRegister();
        return $this->redirect()->toRoute('login');

    }

    public function inicioAction()
    {

    }

    public function getForm()
    {
        if(!$this->form) {
            $usuario = new UsuarioForm();
            $builder = new AnnotationBuilder();
            $this->form = $builder->createForm($usuario);
        }

        return $this->form;
    }
}
