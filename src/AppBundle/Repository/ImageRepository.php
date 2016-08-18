<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * ImageRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ImageRepository extends EntityRepository
{
    //
    //  Catégories des Images aléatoires de la page d'accueil
    //
    public function getCategsImagesByCateg()
    {
        return $this->getEntityManager()
            ->createQuery('SELECT p.imgCat 
                            FROM AppBundle:Image p 
                            GROUP BY p.imgCat 
                            ORDER BY p.imgCat ASC')
            ->getResult();
    }

    //
    //  Images aléatoires de la page d'accueil par Catégorie
    //
    public function getImagesByCateg()
    {
        return $this->getEntityManager()
            ->createQuery('SELECT p 
                            FROM AppBundle:Image p 
                            ORDER BY p.imgCat ASC,  p.imgTitre ASC')
            ->getResult();
    }
}
