<?php
namespace Fanta\Controller;

use Fanta\Entities\User;
use Interop\Container\ContainerInterface;
use Slim\Http\Response;
use Slim\Http\Request;

class Admin
{
    /** @var  ContainerInterface */
    private $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * @return \Slim\Views\Twig
     */
    public function getRenderer()
    {
        return $this->container->twig;
    }

    public function index($request, $response, $args)
    {
        $renderer = $this->getRenderer();
        return $renderer->render($response, 'fanta/admin/index.twig', $args);
    }

    public function userList($request, $response, $args)
    {
        /** @var Doctrine\ORM\EntityManager $em */
        $em = $this->container->entityManager;
        $repo = $em->getRepository('Fanta\Entities\User');
        $users = $repo->findAll();

        $renderer = $this->getRenderer();
        return $renderer->render($response, 'fanta/admin/userList.twig', array(
            'users' => $users,
        ));
    }

    public function userAdd(Request $request, Response $response, $args)
    {
        $data = $request->getParsedBody();
        /** @var Doctrine\ORM\EntityManager $em */
        $em = $this->container->entityManager;
        $user = new User();
        $user->setName($data['name']);
        $em->persist($user);
        $em->flush();

        return $response->withRedirect($this->container->router->pathFor('user-list'));
    }

    public function leagueList($request, $response, $args)
    {
        /** @var Doctrine\ORM\EntityManager $em */
        $em = $this->container->entityManager;
        $repo = $em->getRepository('Fanta\Entities\League');
        $leagues = $repo->findAll();

        $renderer = $this->getRenderer();
        return $renderer->render($response, 'fanta/admin/leagueList.twig', array(
            'leagues' => $leagues,
        ));
    }

    public function leagueDetail($request, $response, $args)
    {
        /** @var Doctrine\ORM\EntityManager $em */
        $em = $this->container->entityManager;
        $repo = $em->getRepository('Fanta\Entities\League');
        $league = $repo->findOneById($args['league_id']);
        $teams = $em->getRepository('Fanta\Entities\Team')->findBy(array('league' => $args['league_id']));

        $renderer = $this->getRenderer();
        return $renderer->render($response, 'fanta/admin/leagueDetail.twig', array(
            'league' => $league,
            'team' => $teams,
        ));
    }
}