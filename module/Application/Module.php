<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2013 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;
use Application\Entity\Usuario;
use Application\Entity\AccessControl;
use Zend\Mvc\Router\Http\RouteMatch;

class Module
{
    public function onBootstrap(MvcEvent $e)
    {
        $app                 = $e->getApplication();

        $em                  = $app->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($em);

        $em->attach(MvcEvent::EVENT_ROUTE, function($e) use ($app) {
            $sm = $e->getApplication()->getServiceManager();
            $match = $e->getRouteMatch();

            // No route match, this is a 404
            if (!$match instanceof RouteMatch) {
                return;
            }

            // Route is login
            $name = $match->getMatchedRouteName();
            $params = $match->getParams();

            if ($name == 'login' || $name == 'login/process') {
                return;
            }

            $viewModel = $app->getMvcEvent()->getViewModel();

            // User is authenticated
            $usuario = Usuario::getRegistered();
            if ($usuario) {

                $ACL = new AccessControl();
                $acceso = $ACL->validateAccess($usuario, $params['controller'], $params['action'], $sm);
                if($acceso) {
                    $viewModel->setVariables(array(
                        'appName'=> $name,
                        'params' => $params,
                    ));
                    return;
                }
                else {
                    $router   = $e->getRouter();
                    $response = $e->getResponse();
                    $url      = $router->assemble(array(), array(
                        'name' => 'home'
                    ));
                    $response->getHeaders()->addHeaderLine('Location', $url);
                    $response->setStatusCode(302);
                    return $response;
                }
            }

            // Redirect to the user login page, as an example
            $router   = $e->getRouter();
            $url      = $router->assemble(array(), array(
                'name' => 'login'
            ));

            $response = $e->getResponse();
            $response->getHeaders()->addHeaderLine('Location', $url);
            $response->setStatusCode(302);

            return ;

        }, -100);

        $sharedEvents = $em->getSharedManager();
        $sharedEvents->attach(__NAMESPACE__, 'dispatch', function($e) {
            $match = $e->getRouteMatch();
            $name = $match->getMatchedRouteName();

            if ($name == 'login' || $name == 'login/process') {
                $controller = $e->getTarget();
                $controller->layout('layout/layout_login');
            }


        }, 100);
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }
}
