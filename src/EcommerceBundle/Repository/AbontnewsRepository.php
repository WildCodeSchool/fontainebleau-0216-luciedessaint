<?php

namespace EcommerceBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * AbontnewsRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class AbontnewsRepository extends EntityRepository
{
    /**
     * Recherche AbonnementNews correspondant à une adresse mail.
     */
    public function findEmail($emailverif)
    {
        return $this->getEntityManager()
            ->createQuery('SELECT a FROM EcommerceBundle:Abontnews a WHERE a.anlEmail = :email')
            ->setParameter('email', $emailverif)
            ->getResult();
    }

    /**
     * Recherche AbonnementsNews inactifs.
     */
    public function findAbontnewsInactifs()
    {
        return $this->getEntityManager()
            ->createQuery('SELECT a FROM EcommerceBundle:Abontnews a 
                            WHERE a.anlEtat = :Etat 
                            ORDER BY a.anlEmail ASC')
            ->setParameter('Etat', false)
            ->getResult();
    }

    /**
     * Recherche AbonnementsNews actifs.
     */
    public function findAbontnewsActifs()
    {
        return $this->getEntityManager()
            ->createQuery('SELECT a FROM EcommerceBundle:Abontnews a 
                            WHERE a.anlEtat = :Etat 
                            ORDER BY a.anlEmail ASC')
            ->setParameter('Etat', true)
            ->getResult();
    }

    /**
     * Recherche AbonnementsNews actifs et correspondants à un code langue.
     */
    public function findAbontnewsActifs4Lang($Lng_Code)
    {
        return $this->getEntityManager()
            ->createQuery('SELECT a FROM EcommerceBundle:Abontnews a 
                            WHERE (a.anlLocale = :CodeLng AND a.anlEtat = :Etat) 
                            ORDER BY a.anlEmail ASC')
            ->setParameter('CodeLng', $Lng_Code)
            ->setParameter('Etat', true)
            ->getResult();
    }
}
