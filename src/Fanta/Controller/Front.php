<?php
namespace Fanta\Controller;

use Doctrine\ORM\EntityManager;
use Fanta\Entity\Contract;
use Fanta\Entity\Team;
use Fanta\Entity\User;
use Interop\Container\ContainerInterface;
use Slim\Http\Response;
use Slim\Http\Request;

class Front
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
        return $renderer->render($response, 'fanta/front/index.twig', $args);
    }

    public function login(Request $request, $response, $args)
    {
        /** @var EntityManager $em */
        $em = $this->container->entityManager;
        $data = $request->getParsedBody();
        $user = $em->getRepository('Fanta\Entity\User')->findOneBy(array('name' => $data['user']));
        if (!$user) {
            return $response->withStatus(403, 'User not found');
        }
        if ($user->getPassword() != $this->container->auth->getEncryptedPassword($data['password'])) {
            return $response->withStatus(403, 'Incorrect password');
        }
        $this->container->session->createSession($user);
        return $response->withRedirect($this->container->router->pathFor('front-teams'));
    }

    public function logout(Request $request, $response, $args)
    {
        $this->container->session->destroySession($user);
        return $response->withRedirect($this->container->router->pathFor('front-index'));
    }

    public function leagueList($request, $response, $args)
    {
        /** @var Doctrine\ORM\EntityManager $em */
        $em = $this->container->entityManager;
        $repo = $em->getRepository('Fanta\Entity\League');
        $leagues = $repo->findAll();

        $renderer = $this->getRenderer();
        return $renderer->render($response, 'fanta/front/leagueList.twig', array(
            'leagues' => $leagues,
        ));
    }

    public function leagueDetail($request, $response, $args)
    {
        /** @var Doctrine\ORM\EntityManager $em */
        $em = $this->container->entityManager;
        $league = $em->find('Fanta\Entity\League', $args['league_id']);
        $teams = $em->getRepository('Fanta\Entity\Team')->findBy(array('league' => $args['league_id']));
        $users = $em->getRepository('Fanta\Entity\User')->findAll();

        $renderer = $this->getRenderer();
        return $renderer->render($response, 'fanta/front/leagueDetail.twig', array(
            'league' => $league,
            'teams' => $teams,
            'users' => $users,
        ));
    }

    public function teamList($request, $response, $args)
    {
        $user_id = $this->container->session->getVar('userid');

        /** @var Doctrine\ORM\EntityManager $em */
        $em = $this->container->entityManager;
        $repo = $em->getRepository('Fanta\Entity\Team');
        $teams = $repo->findBy(array('user'=>$user_id));

        $renderer = $this->getRenderer();
        return $renderer->render($response, 'fanta/front/teamList.twig', array(
            'teams' => $teams,
        ));
    }

    public function teamDetail($request, $response, $args)
    {
        /** @var EntityManager $em */
        $em = $this->container->entityManager;
        $team = $em->find('Fanta\Entity\Team', $args['team_id']);
        $players = $em->getRepository('Fanta\Entity\PLayer')->findAll();

        $renderer = $this->getRenderer();
        return $renderer->render($response, 'fanta/front/teamDetail.twig', array(
            'team' => $team,
            'players' => $players,
        ));
    }


}