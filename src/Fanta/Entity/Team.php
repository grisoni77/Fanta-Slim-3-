<?php
namespace Fanta\Entity;

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
     * @ORM\OneToMany(targetEntity="Contract", mappedBy="team")
     **/
    protected $contracts;
    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Team
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set user
     *
     * @param \Fanta\Entity\User $user
     *
     * @return Team
     */
    public function setUser(\Fanta\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \Fanta\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set league
     *
     * @param \Fanta\Entity\League $league
     *
     * @return Team
     */
    public function setLeague(\Fanta\Entity\League $league = null)
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
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->contracts = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add contract
     *
     * @param \Fanta\Entity\Contract $contract
     *
     * @return Team
     */
    public function addContract(\Fanta\Entity\Contract $contract)
    {
        $this->contracts[] = $contract;

        return $this;
    }

    /**
     * Remove contract
     *
     * @param \Fanta\Entity\Contract $contract
     */
    public function removeContract(\Fanta\Entity\Contract $contract)
    {
        $this->contracts->removeElement($contract);
    }

    /**
     * Get contracts
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getContracts()
    {
        return $this->contracts;
    }
}
