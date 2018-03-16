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
 * Class Task
 * @package AppBundle\Entity
 * @ORM\Entity(repositoryClass="AppBundle\Repository\TaskRepository")
 * @ORM\Table(name="task")
 */
class Task
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(name="name", type="string")
     */
    private $name;

    /**
     * @ORM\Column(name="description", type="string")
     */
    private $description;

    /**
     *  @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime",nullable=false)
     */
    private $created_at;

    /**
     *  @var \DateTime
     *
     * @ORM\Column(name="updated_at", type="datetime",nullable=false)
     */
    private $updated_at;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="Subtask", mappedBy="main_task")
     */
    private $sub_tasks;


    /**
     * Task constructor.
     */
    public function __construct()
    {
        $this->sub_tasks = new ArrayCollection();
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
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
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
     * @return ArrayCollection
     */
    public function getSubTasks()
    {
        return $this->sub_tasks;
    }

    /**
     * @param ArrayCollection $sub_tasks
     */
    public function setSubTasks($sub_tasks)
    {
        $this->sub_tasks = $sub_tasks;
    }
    /**
     * @ORM\PrePersist
     * @ORM\PreUpdate
     */
    public function updatedTimestamps()
    {
        $this->setUpdatedAt(new \DateTime('now'));
        if ($this->getCreatedAt() == null) {
            $this->setCreatedAt(new \DateTime('now'));
        }
    }
}