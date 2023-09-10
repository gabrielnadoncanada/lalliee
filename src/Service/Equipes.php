<?php

namespace App\Service;
use App\Entity\Equipe;
use Doctrine\ORM\EntityManagerInterface;

class Equipes {

    private $em;
    private $paginator;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->em = $entityManager;
    }

    public function getAll($request)
    {
        $query = "
                SELECT DISTINCT f
                FROM App\Entity\Equipe f
                ORDER BY f.title DESC
            ";

        $query = $this->em->createQuery($query);

        $res = $query->getResult();

        return $res;
    }

}

