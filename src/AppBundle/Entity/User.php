<?php
/**
 * Created by IntelliJ IDEA.
 * User: Nestor
 * Date: 27/02/2018
 * Time: 16:27
 */

namespace AppBundle\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class User
 * @package AppBundle\Entity
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UserRepository")
 * @ORM\Table(name="user")
 */

class User
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;
    /* @ORM\Column(name="name", type="string") */
    private $name;
    /* @ORM\Column(name="age", type="integer") */
    private $edad;
    /**
     * @var ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="Subtask", inversedBy="users")
     * @ORM\JoinTable(
     *  name="user_has_subtask",
     *  joinColumns={
     *      @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     *  },
     *  inverseJoinColumns={
     *      @ORM\JoinColumn(name="subtask_id", referencedColumnName="id")
     *  }
     * )
     */
    private $subtasks;
    /* @ORM\Column(name="created_at", type="datetime") */
    private $created_at;
    /* @ORM\Column(name="updated_at", type="datetime") */
    private $updated_at;

    /**
     * User constructor.
     */
    public function __construct()
    {
        $this->subtasks = new ArrayCollection();
    }

    /**
     * @return ArrayCollection
     */
    public function getSubtasks()
    {
        return $this->subtasks;
    }

    /**
     * @param ArrayCollection $subtasks
     */
    public function setSubtasks($subtasks)
    {
        $this->subtasks = $subtasks;
    }


    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getEdad()
    {
        return $this->edad;
    }

    /**
     * @param mixed $edad
     */
    public function setEdad($edad)
    {
        $this->edad = $edad;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * @param mixed $created_at
     */
    public function setCreatedAt($created_at)
    {
        $this->created_at = $created_at;
    }

    /**
     * @return mixed
     */
    public function getUpdatedAt()
    {
        return $this->updated_at;
    }

    /**
     * @param mixed $updated_at
     */
    public function setUpdatedAt($updated_at)
    {
        $this->updated_at = $updated_at;
    }

    /**
     * @param Subtask $subtask
     */
    public function addSubTask(Subtask $subtask){
        if ($this->subtasks->contains($subtask)) {
            return;
        }
        $this->subtasks->add($subtask);
        $subtask->addUser($this);
    }

    /**
     * @param Subtask $subtask
     */
    public function removeUserGroup(Subtask $subtask)
    {
        if (!$this->subtasks->contains($subtask)) {
            return;
        }
        $this->subtasks->removeElement($subtask);
        $subtask->removeUser($this);
    }

    /**
     * @ORM\PrePersist
     * @ORM\PreUpdate
     */
    public function prePersist()
    {
        if (!$this->getCreatedAt()) {
            $this->created_at = new \DateTime();
        }
        if (!$this->getUpdatedAt()) {
            $this->updated_at = new \DateTime();
        }
    }
}