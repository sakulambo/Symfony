<?php
/**
 * Created by IntelliJ IDEA.
 * User: Kevin
 * Date: 27/02/2018
 * Time: 18:36
 */

namespace AppBundle\Services;


use Symfony\Component\DependencyInjection\ContainerInterface;

class BaseService
{
    /**
     * @var ContainerInterface
     */

    protected $container;

    /**
     * Sets the container.
     *
     * @param ContainerInterface|null $container A ContainerInterface instance or null
     */

    public function setContainer(ContainerInterface $container = null)

    {

        $this->container = $container;

    }

    public function get($key){
        $this->container->get($key);

    }

}