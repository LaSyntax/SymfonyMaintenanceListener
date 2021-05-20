<?php

/**
 * src/Services/Listener/MaintenanceListener.php
 */

namespace App\Services\Listener;

use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Twig\Environment;

class MaintenanceListener
{
    // Container
    private $container;
    // Engine
    public $_engine;


    public function __construct(ContainerInterface $container, Environment $engine)
    {
        $this->container = $container;
        $this->_engine = $engine;
    }

    public function onKernelRequest(RequestEvent $event)
    {

        // What route will be available publicly even in maintenance
        $allowRoutesInMaintenance = [
            "app_reset_password",
            "app_forgot_password_request",
            "app_login",
            "app_logout"
        ];

        // get maintenance parameter
        $maintenance = $this->container->hasParameter('maintenance') ? $this->container->getParameter('maintenance') : null;

        // Debug mode
        $debug = in_array($this->container->get('kernel')->getEnvironment(), array('test'));

        // If maintenance mode is turn on
        if ($maintenance && !$debug) {

            // Get the route name
            $route_name = $event->getRequest()->attributes->get('_route');

            // If $route_name isn't in $allowRoutesInMaintenance
            if (!in_array($route_name, $allowRoutesInMaintenance)) {

                // The user don't have the allowed role (people who can surf even in maintenance)
                if (!$this->container->get('security.authorization_checker')->isGranted('ROLE_TEAM')) {

                    // Be sure maintenance/index.html.twig is your maintenance twig template, fix it correctly
                    $content = $this->_engine->render('maintenance/index.html.twig', []);

                    // Send response
                    $event->setResponse(new Response($content, 503));

                    // Stop the event propagation
                    $event->stopPropagation();
                }
            }
        }
    }
}
