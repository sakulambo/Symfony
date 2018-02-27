<?php
/**
 * Created by IntelliJ IDEA.
 * User: Nestor
 * Date: 27/02/2018
 * Time: 16:28
 */

namespace AppBundle\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
/**
 * Class Subtask
 * @package AppBundle\Entity
 * @ORM\Entity(repositoryClass="AppBundle\Repository\SubtaskRepository")
 * @ORM\Table(name="sub_task")
 */
class Subtask
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;
    /**
     * @var ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="User", mappedBy="subtasks")
     */
    private $users;
    /**
     * @ORM\ManyToOne(targetEntity="Task", inversedBy="sub_task")
     */
    private $parent_task;

    /**
     * @ORM\Column(name="description", type="string")
     */
    private $desciption;

    /**
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $created_at;
    /**
     * @ORM\Column(name="updated_at", type="datetime")
     */
    private $updated_at;

    /**
     * Subtask constructor.
     */
    public function __construct()
    {
        $this->users = new ArrayCollection();
    }


    /**
     * @return mixed
     */
    public function getUsers()
    {
        return $this->users;
    }

    /**
     * @param mixed $users
     */
    public function setUsers($users)
    {
        $this->users = $users;
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
    public function getParentTask()
    {
        return $this->parent_task;
    }

    /**
     * @param mixed $parent_task
     */
    public function setParentTask($parent_task)
    {
        $this->parent_task = $parent_task;
    }

    /**
     * @return mixed
     */
    public function getDesciption()
    {
        return $this->desciption;
    }

    /**
     * @param mixed $desciption
     */
    public function setDesciption($desciption)
    {
        $this->desciption = $desciption;
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
     * @param User $user
     */
    public function addUser(User $user)
    {
        if ($this->users->contains($user)) {
            return;
        }
        $this->users->add($user);
        $user->addSubTask($this);
    }

    /**
     * @param User $user
     */
    public function removeUser(User $user)
    {
        if (!$this->users->contains($user)) {
            return;
        }
        $this->users->removeElement($user);
        $user->removeUserGroup($this);
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