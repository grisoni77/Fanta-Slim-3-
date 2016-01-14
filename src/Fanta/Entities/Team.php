<?php
namespace Fanta\Entities;

use Doctrine\ORM\Mapping AS ORM;

/**
 * @ORM\Entity(repositoryClass="Fanta\Repository\Team")
 * @ORM\Table(name="teams")
 **/
class Team
{
    /** @ORM\Id @ORM\Column(type="integer") @ORM\GeneratedValue **/
    protected $id;
    /** @ORM\Column(type="string") **/
    protected $name;
    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="teams")
     **/
    protected $user;
    /**
     * @ORM\ManyToOne(targetEntity="League", inversedBy="teams")
     **/
    protected $league;
    /**
     * @ORM\OneToMany(targetEntity="Player", mappedBy="team")
     **/
    protected $players;

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->players = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add player
     *
     * @param \Fanta\Entities\Player $player
     *
     * @return Team
     */
    public function addPlayer(\Fanta\Entities\Player $player)
    {
        $this->players[] = $player;

        return $this;
    }

    /**
     * Remove player
     *
     * @param \Fanta\Entities\Player $player
     */
    public function removePlayer(\Fanta\Entities\Player $player)
    {
        $this->players->removeElement($player);
    }

    /**
     * Get players
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPlayers()
    {
        return $this->players;
    }

    /**
     * Set user
     *
     * @param \Fanta\Entities\User $user
     *
     * @return Team
     */
    public function setUser(\Fanta\Entities\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \Fanta\Entities\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set league
     *
     * @param \Fanta\Entities\League $league
     *
     * @return Team
     */
    public function setLeague(\Fanta\Entities\League $league = null)
    {
        $this->league = $league;

        return $this;
    }

    /**
     * Get league
     *
     * @return \Fanta\Entities\League
     */
    public function getLeague()
    {
        return $this->league;
    }
}
