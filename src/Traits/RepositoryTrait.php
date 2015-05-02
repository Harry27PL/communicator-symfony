<?php

namespace Traits;

trait RepositoryTrait
{
    public function add($entity)
    {
        $this->em->persist($entity);
        $this->em->flush();
    }

    public function update()
    {
        $this->em->flush();
    }

    public function persist($obj)
    {
        $this->em->persist($obj);
    }

    public function remove($entity)
    {
        $this->em->remove($entity);
        $this->em->flush();
    }
}