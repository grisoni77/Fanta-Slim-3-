<?php

namespace Fanta\Middleware;

use Interop\Container\ContainerInterface;
use Slim\Http\Request;
use Slim\Http\Response;

class Auth
{
    /**
     * @var ContainerInterface
     */
    private $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * Example middleware invokable class
     *
     * @param  Slim\Http\Request $request  PSR7 request
     * @param  Slim\Http\Response      $response PSR7 response
     * @param  callable                                 $next     Next middleware
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function __invoke(Request $request, Response $response, $next)
    {
        $route = $request->getAttribute('route');
        $session = $this->container->session;
        $user_id = $session->getVar('userid', 0);

        if (!$this->hasAccess($route, $user_id)) {
            $router = $this->container->router;
            //return $response->withStatus(403);
            return $response->withRedirect($router->pathFor('front-index'));
        }
        $response = $next($request, $response);
        return $response;
    }

    private function hasAccess($route, $user_id)
    {
        switch ($route->getName())
        {
            case 'front-teams':
                return $this->isLoggedinUser($user_id);
                break;

            case 'front-team-detail':
                return $this->userOwnsTeam($user_id, $route->getArguments()['team_id']);
                break;
        }

        return true;
    }

    private function isLoggedInUser($user)
    {
        return !empty($user);
    }

    private function userOwnsTeam($user_id, $team_id)
    {
        $em = $this->container->entityManager;
        $team = $em->find('Fanta\\Entity\\Team', $team_id);

        return $team->getUser()->getId() == $user_id;
    }
}