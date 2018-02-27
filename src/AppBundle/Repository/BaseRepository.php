<?php
/**
 * Created by IntelliJ IDEA.
 * User: Kevin
 * Date: 27/02/2018
 * Time: 16:53
 */

namespace AppBundle\Repository;


use Doctrine\ORM\EntityRepository;

class BaseRepository extends EntityRepository
{
    public function update($entity, $flush = true){

        $em = $this->getEntityManager();

        $em->merge($entity);

        if($flush)
            $em->flush();

        return true;

    }

    public function save($entity, $flush = true){
        $em = $this->getEntityManager();

        $em->persist($entity);

        if($flush)

            $em->flush();

        return true;

    }

    public function delete($entity){
        $em = $this->getEntityManager();

        $em->remove($entity);

        $em->flush();

        return true;

    }

    public function refresh($entity, $flush = true){
        $em = $this->getEntityManager();

        $em->refresh($entity);

        if($flush)

            $em->flush();

        return true;

    }

    public function flush(){
        $this->getEntityManager()->flush();
    }


}