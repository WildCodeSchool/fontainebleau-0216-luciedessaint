<?php

namespace EcommerceBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * ProdlibRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ProdlibRepository extends EntityRepository
{

    public function getProdlib4ProdLang($id_prod, $langue)
    {
        $qb = $this
            ->createQueryBuilder('c')
            ->where('c.pdlIdpdt = :idProd')
            ->setParameter('idProd', $id_prod)
            ->andWhere('c.pdlLocale = :lang')
            ->setParameter('lang', $langue)
        ;
        return $qb->getQuery()->getResult();
    }

}
