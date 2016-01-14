<?php
namespace Fanta\Entity;

use Doctrine\ORM\Mapping AS ORM;

/**
 * @ORM\Entity(repositoryClass="Fanta\Repository\User")
 * @ORM\Table(name="users")
 **/
class User
{
    /** @ORM\Id @ORM\Column(type="integer") @ORM\GeneratedValue **/
    protected $id;
    /** @ORM\Column(type="string") **/
    protected $name;
    /** @ORM\Column(type="string") **/
    protected $password;
    /**
     * @ORM\OneToMany(targetEntity="Team", mappedBy="user")
     **/
    protected $teams;

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
        $this->teams = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add team
     *
     * @param \Fanta\Entity\Team $team
     *
     * @return User
     */
    public function addTeam(\Fanta\Entity\Team $team)
    {
        $this->teams[] = $team;

        return $this;
    }

    /**
     * Remove team
     *
     * @param \Fanta\Entity\Team $team
     */
    public function removeTeam(\Fanta\Entity\Team $team)
    {
        $this->teams->removeElement($team);
    }

    /**
     * Get teams
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTeams()
    {
        return $this->teams;
    }

    /**
     * Set password
     *
     * @param string $password
     *
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }
}
