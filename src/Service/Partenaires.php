<?php

namespace App\Service;
use App\Entity\Partenaire;
use Doctrine\ORM\EntityManagerInterface;

class Partenaires {

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
                FROM App\Entity\Partenaire f
                ORDER BY f.title DESC
            ";

        $query = $this->em->createQuery($query);

        $res = $query->getResult();

        return $res;
    }

}

