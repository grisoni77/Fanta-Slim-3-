<?php
namespace Fanta\Entities;

use Doctrine\ORM\Mapping AS ORM;

/**
 * @ORM\Entity(repositoryClass="Fanta\Repository\Player")
 * @ORM\Table(name="players")
 **/
class Player
{
    /** @ORM\Id @ORM\Column(type="integer") @ORM\GeneratedValue **/
    protected $id;
    /** @ORM\Column(type="string") **/
    protected $name;
    /**
     * @ORM\ManyToOne(targetEntity="Team", inversedBy="players")
     **/
    protected $team;

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
     * Set team
     *
     * @param \Fanta\Entities\Team $team
     *
     * @return Player
     */
    public function setTeam(\Fanta\Entities\Team $team = null)
    {
        $this->team = $team;

        return $this;
    }

    /**
     * Get team
     *
     * @return \Fanta\Entities\Team
     */
    public function getTeam()
    {
        return $this->team;
    }
}
