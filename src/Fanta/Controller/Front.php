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