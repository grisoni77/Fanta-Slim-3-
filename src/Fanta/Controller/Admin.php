<?php
namespace Fanta\Controller;

use Doctrine\ORM\EntityManager;
use Fanta\Entity\Contract;
use Fanta\Entity\Team;
use Fanta\Entity\User;
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
        $repo = $em->getRepository('Fanta\Entity\User');
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
        $repo = $em->getRepository('Fanta\Entity\League');
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
        $league = $em->find('Fanta\Entity\League', $args['league_id']);
        $teams = $em->getRepository('Fanta\Entity\Team')->findBy(array('league' => $args['league_id']));
        $users = $em->getRepository('Fanta\Entity\User')->findAll();

        $renderer = $this->getRenderer();
        return $renderer->render($response, 'fanta/admin/leagueDetail.twig', array(
            'league' => $league,
            'teams' => $teams,
            'users' => $users,
        ));
    }

    public function teamAdd(Request $request, Response $response, $args)
    {
        $data = $request->getParsedBody();
        /** @var EntityManager $em */
        $em = $this->container->entityManager;
        $team = new Team();
        $team->setName($data['name']);
        $team->setLeague($em->find('Fanta\Entity\League', $data['league_id']));
        $team->setUser($em->find('Fanta\Entity\User', $data['user_id']));
        $team->setName($data['name']);
        $em->persist($team);
        $em->flush();

        return $response->withRedirect($this->container->router->pathFor('league-detail', array(
            'league_id' => $data['league_id']
        )));
    }

    public function teamDetail($request, $response, $args)
    {
        /** @var EntityManager $em */
        $em = $this->container->entityManager;
        $team = $em->find('Fanta\Entity\Team', $args['team_id']);
        $players = $em->getRepository('Fanta\Entity\PLayer')->findAll();

        $renderer = $this->getRenderer();
        return $renderer->render($response, 'fanta/admin/teamDetail.twig', array(
            'team' => $team,
            'players' => $players,
        ));
    }

    public function contractAdd($request, $response, $args)
    {
        $data = $request->getParsedBody();
        /** @var EntityManager $em */
        $em = $this->container->entityManager;
        $team = $em->find('Fanta\Entity\Team', $data['team_id']);
        $player = $em->find('Fanta\Entity\Player', $data['player_id']);
        $contract = new Contract();
        $contract->setPlayer($player);
        $contract->setTeam($team);
        $contract->setLeague($team->getLeague());
        $contract->setCost($data['cost']);
        $em->persist($contract);
        $em->flush();

        return $response->withRedirect($this->container->router->pathFor('team-detail', array(
            'league_id' => $team->getLeague()->getId(),
            'team_id' => $data['team_id']
        )));
    }
}