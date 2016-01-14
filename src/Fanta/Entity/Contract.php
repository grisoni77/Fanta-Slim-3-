<?php
namespace Fanta\Entity;

use Doctrine\ORM\Mapping AS ORM;

/**
 * @ORM\Entity(repositoryClass="Fanta\Repository\Contract")
 * @ORM\Table(name="contracts")
 **/
class Contract
{
    /** @ORM\Column(type="integer") */
    protected $cost;

    /**
     * @ORM\Id()
     * @ORM\ManyToOne(targetEntity="Player", inversedBy="contracts")
     * @ORM\JoinColumn(name="player_id", referencedColumnName="id", nullable=false)
     */
    protected $player;

    /**
     * @ORM\Id()
     * @ORM\ManyToOne(targetEntity="Team", inversedBy="contracts")
     * @ORM\JoinColumn(name="team_id", referencedColumnName="id", nullable=false)
     */
    protected $team;

    /**
     * @ORM\Id()
     * @ORM\ManyToOne(targetEntity="League", inversedBy="contracts")
     * @ORM\JoinColumn(name="league_id", referencedColumnName="id", nullable=false)
     */
    protected $league;

    /**
     * Set cost
     *
     * @param integer $cost
     *
     * @return Contract
     */
    public function setCost($cost)
    {
        $this->cost = $cost;

        return $this;
    }

    /**
     * Get cost
     *
     * @return integer
     */
    public function getCost()
    {
        return $this->cost;
    }

    /**
     * Set player
     *
     * @param \Fanta\Entity\Player $player
     *
     * @return Contract
     */
    public function setPlayer(\Fanta\Entity\Player $player)
    {
        $this->player = $player;

        return $this;
    }

    /**
     * Get player
     *
     * @return \Fanta\Entity\Player
     */
    public function getPlayer()
    {
        return $this->player;
    }

    /**
     * Set team
     *
     * @param \Fanta\Entity\Team $team
     *
     * @return Contract
     */
    public function setTeam(\Fanta\Entity\Team $team)
    {
        $this->team = $team;

        return $this;
    }

    /**
     * Get team
     *
     * @return \Fanta\Entity\Team
     */
    public function getTeam()
    {
        return $this->team;
    }

    /**
     * Set league
     *
     * @param \Fanta\Entity\League $league
     *
     * @return Contract
     */
    public function setLeague(\Fanta\Entity\League $league)
    {
        $this->league = $league;

        return $this;
    }

    /**
     * Get league
     *
     * @return \Fanta\Entity\League
     */
    public function getLeague()
    {
        return $this->league;
    }
}
