<?php

namespace EcommerceBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * ProduitRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ProduitRepository extends EntityRepository
{

    ///////////////////////////////////////////////////////////////////////////////////////////////
    //
    //  BIJOUX / ETAT
    //
    public function getCatBijoux_4VENTE_ByCat()
    {
        return $this->getEntityManager()
            ->createQuery('SELECT b.catLibAdmin, b.catPhoto 
                            FROM EcommerceBundle:Produit p JOIN p.pdtIdcat b 
                            WHERE ((b.catLibAdmin LIKE :CatP1 OR b.catLibAdmin LIKE :CatP2) 
                             AND p.pdtEtat = :EtatP AND p.pdtAvendre = :AvendreP) 
                            GROUP BY b.catLibAdmin 
                            ORDER BY b.catLibAdmin ASC')
            ->setParameter('CatP1', 'Bijou%')
            ->setParameter('CatP2', 'bijou%')
            ->setParameter('EtatP', true)
            ->setParameter('AvendreP', true)
            ->getResult();
    }

    public function getBijoux_4VENTE_ByCat()
    {
        return $this->getEntityManager()
            ->createQuery('SELECT p, b 
                            FROM EcommerceBundle:Produit p JOIN p.pdtIdcat b 
                            WHERE ((b.catLibAdmin LIKE :CatP1 OR b.catLibAdmin LIKE :CatP2) 
                             AND p.pdtEtat = :EtatP AND p.pdtAvendre = :AvendreP) 
                            ORDER BY b.catLibAdmin ASC,  p.pdtRef ASC')
            ->setParameter('CatP1', 'Bijou%')
            ->setParameter('CatP2', 'bijou%')
            ->setParameter('EtatP', true)
            ->setParameter('AvendreP', true)
            ->getResult();
    }
    
    public function getCatBijoux_4VENDUS_ByCat()
    {
        return $this->getEntityManager()
            ->createQuery('SELECT b.catLibAdmin, b.catPhoto 
                            FROM EcommerceBundle:Produit p JOIN p.pdtIdcat b 
                            WHERE ((b.catLibAdmin LIKE :CatP1 OR b.catLibAdmin LIKE :CatP2) 
                             AND p.pdtAvendre = :AvendreP) 
                            GROUP BY b.catLibAdmin 
                            ORDER BY b.catLibAdmin ASC')
            ->setParameter('CatP1', 'Bijou%')
            ->setParameter('CatP2', 'bijou%')
            ->setParameter('AvendreP', false)
            ->getResult();
    }

    public function getBijoux_4VENDUS_ByCat()
    {
        return $this->getEntityManager()
            ->createQuery('SELECT p, b 
                            FROM EcommerceBundle:Produit p JOIN p.pdtIdcat b 
                            WHERE ((b.catLibAdmin LIKE :CatP1 OR b.catLibAdmin LIKE :CatP2) 
                             AND p.pdtAvendre = :AvendreP) 
                            ORDER BY b.catLibAdmin ASC,  p.pdtRef ASC')
            ->setParameter('CatP1', 'Bijou%')
            ->setParameter('CatP2', 'bijou%')
            ->setParameter('AvendreP', false)
            ->getResult();
    }

    public function getCatBijoux_4Inactifs_ByCat()
    {
        return $this->getEntityManager()
            ->createQuery('SELECT b.catLibAdmin, b.catPhoto 
                            FROM EcommerceBundle:Produit p JOIN p.pdtIdcat b 
                            WHERE ((b.catLibAdmin LIKE :CatP1 OR b.catLibAdmin LIKE :CatP2) 
                             AND p.pdtEtat = :EtatP AND p.pdtAvendre = :AvendreP) 
                            GROUP BY b.catLibAdmin 
                            ORDER BY b.catLibAdmin ASC')
            ->setParameter('CatP1', 'Bijou%')
            ->setParameter('CatP2', 'bijou%')
            ->setParameter('EtatP', false)
            ->setParameter('AvendreP', true)
            ->getResult();
    }

    public function getBijoux_4Inactifs_ByCat()
    {
        return $this->getEntityManager()
            ->createQuery('SELECT p, b 
                            FROM EcommerceBundle:Produit p JOIN p.pdtIdcat b 
                            WHERE ((b.catLibAdmin LIKE :CatP1 OR b.catLibAdmin LIKE :CatP2) 
                             AND p.pdtEtat = :EtatP AND p.pdtAvendre = :AvendreP) 
                            ORDER BY b.catLibAdmin ASC,  p.pdtNom ASC')
            ->setParameter('CatP1', 'Bijou%')
            ->setParameter('CatP2', 'bijou%')
            ->setParameter('EtatP', false)
            ->setParameter('AvendreP', true)
            ->getResult();
    }

    ///////////////////////////////////////////////////////////////////////////////////////////////
    //
    //  BIJOUX / CATEGORIE
    //
    public function getCatBijoux_ByCat()
    {
        return $this->getEntityManager()
            ->createQuery('SELECT b.catLibAdmin, b.catPhoto 
                            FROM EcommerceBundle:Produit p JOIN p.pdtIdcat b 
                            WHERE ((b.catLibAdmin LIKE :CatP1 OR b.catLibAdmin LIKE :CatP2)) 
                            GROUP BY b.catLibAdmin 
                            ORDER BY b.catLibAdmin ASC')
            ->setParameter('CatP1', 'Bijou%')
            ->setParameter('CatP2', 'bijou%')
            ->getResult();
    }

    public function getBijoux_ByCat()
    {
        return $this->getEntityManager()
            ->createQuery('SELECT p, b 
                            FROM EcommerceBundle:Produit p JOIN p.pdtIdcat b 
                            WHERE ((b.catLibAdmin LIKE :CatP1 OR b.catLibAdmin LIKE :CatP2)) 
                            ORDER BY b.catLibAdmin ASC,  p.pdtRef ASC')
            ->setParameter('CatP1', 'Bijou%')
            ->setParameter('CatP2', 'bijou%')
            ->getResult();
    }

    ///////////////////////////////////////////////////////////////////////////////////////////////
    //
    //  TABLEAUX / ETAT
    //
    public function getCatTableaux_4ETAT_ByCat($etat)
    {
        return $this->getEntityManager()
            ->createQuery('SELECT b.catLibAdmin, b.catPhoto 
                            FROM EcommerceBundle:Produit p JOIN p.pdtIdcat b 
                            WHERE ((b.catLibAdmin LIKE :CatP1 OR b.catLibAdmin LIKE :CatP2) 
                             AND p.pdtEtat = :EtatP) 
                            GROUP BY b.catLibAdmin 
                            ORDER BY b.catLibAdmin ASC')
            ->setParameter('CatP1', 'Tableau%')
            ->setParameter('CatP2', 'tableau%')
            ->setParameter('EtatP', $etat)
            ->getResult();
    }

    public function getTableaux_4ETAT_ByCat($etat)
    {
        return $this->getEntityManager()
            ->createQuery('SELECT p, b 
                            FROM EcommerceBundle:Produit p JOIN p.pdtIdcat b 
                            WHERE ((b.catLibAdmin LIKE :CatP1 OR b.catLibAdmin LIKE :CatP2) 
                             AND p.pdtEtat = :EtatP) 
                            ORDER BY b.catLibAdmin ASC,  p.pdtRef ASC')
            ->setParameter('CatP1', 'Tableau%')
            ->setParameter('CatP2', 'tableau%')
            ->setParameter('EtatP', $etat)
            ->getResult();
    }

    ///////////////////////////////////////////////////////////////////////////////////////////////
    //
    //  TABLEAUX / CATEGORIE
    //
    public function getCatTableaux_ByCat()
    {
        return $this->getEntityManager()
            ->createQuery('SELECT b.catLibAdmin, b.catPhoto 
                            FROM EcommerceBundle:Produit p JOIN p.pdtIdcat b 
                            WHERE ((b.catLibAdmin LIKE :CatP1 OR b.catLibAdmin LIKE :CatP2)) 
                            GROUP BY b.catLibAdmin 
                            ORDER BY b.catLibAdmin ASC')
            ->setParameter('CatP1', 'Tableau%')
            ->setParameter('CatP2', 'tableau%')
            ->getResult();
    }

    public function getTableaux_ByCat()
    {
        return $this->getEntityManager()
            ->createQuery('SELECT p, b 
                            FROM EcommerceBundle:Produit p JOIN p.pdtIdcat b 
                            WHERE ((b.catLibAdmin LIKE :CatP1 OR b.catLibAdmin LIKE :CatP2)) 
                            ORDER BY b.catLibAdmin ASC,  p.pdtRef ASC')
            ->setParameter('CatP1', 'Tableau%')
            ->setParameter('CatP2', 'tableau%')
            ->getResult();
    }
}

