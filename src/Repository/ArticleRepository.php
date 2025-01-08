<?php

namespace App\Repository;

use App\Entity\Article;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Article>
 * @method Article|null find($id, $lockMode = null, $lockVersion = null)
 * @method Article|null findOneBy(array $criteria, array $orderBy = null)
 * @method Article[]    findAll()
 * @method Article[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArticleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Article::class);
    }

    /**
     * @return Articles[] Returns an array of Users objects
     */
    public function getTriAsc(string $champ): array
    {
        $query = $this->createQueryBuilder('a')
            ->select('a')
            ->orderBy('a.' . $champ, 'ASC')
            ->getQuery();
        return $query->getResult();
    }

    /**
     * @return Article[] Returns an array of Article objects
     */
    /*public function getTriAsc(string $champ): array
    {
    $query = $this->createQueryBuilder('a')
    ->select('a')
    ->orderBy('a.' . $champ, 'ASC')
    ->getQuery();
    return $query->getResult();
    } */

    public function findTrieArtcles_AZ()
    {
        return $this->createQueryBuilder('a')
            ->select('a')
            ->orderBy('a.titre', 'ASC')
            ->getQuery()
            ->getResult();
    }

    public function findTrietype_AZ()
    {
        return $this->createQueryBuilder('a')
            ->select('a')
            ->orderBy('a.type', 'ASC')
            ->getQuery()
            ->getResult();
    }

    public function findTrieAdresse_AZ()
    {
        return $this->createQueryBuilder('a')
            ->select('a')
            ->orderBy('a.adresse', 'ASC')
            ->getQuery()
            ->getResult();
    }

    #Affichage des artciles a la UNE
    public function findUne()
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.une = : false')

            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }

    public function findTrieSurface_AZ()
    {
        return $this->createQueryBuilder('a')
            ->orderBy('a.surface', 'ASC')
            ->getQuery()
            ->getResult();
    }

    public function findAscPrice()
    {
        return $this->createQueryBuilder('a')
            ->orderBy('a.prix', 'ASC')
            ->getQuery()
            ->getResult();
    }

    //Lister les Articles de Categorie Location-Appartement
    public function findCategorieLocAppart(): array
    {
        return $this->createQueryBuilder('a')
            ->join('a.categorie', 'v')
            ->andWhere('v.titre= :val')
            ->setParameter('val', 'location-Appart')
            ->orderBy('a.agence', 'ASC')
            ->getQuery()
            ->getResult();
    }

    //Lister les Articles de Categorie Location-Maison
    public function findCategorieLocMaison(): array
    {
        return $this->createQueryBuilder('a')
            ->join('a.categorie', 'v')
            ->andWhere('v.titre= :val')
            ->setParameter('val', 'location-Maison')
            ->orderBy('a.id', 'ASC')
            ->getQuery()
            ->getResult();
    }

    //Lister les Articles de Categorie vente-Appartement
    public function findCategorieVenteAppart(): array
    {
        return $this->createQueryBuilder('a')
            ->join('a.categorie', 'v')
            ->andWhere('v.titre= :val')
            ->setParameter('val', 'Vente-Appart')
            ->orderBy('a.id', 'ASC')
            ->getQuery()
            ->getResult();
    }

    //Lister les Articles de Categorie Vente-Maison
    public function findCategorieVenteMaison(): array
    {
        return $this->createQueryBuilder('a')
            ->join('a.categorie', 'v')
            ->andWhere('v.titre= :val')
            ->setParameter('val', 'Vente-Maison')
            ->orderBy('a.adresse', 'ASC')
            ->getQuery()
            ->getResult();

    }

    public function findCategorieVenteAppartn(): array
    {
        return $this->createQueryBuilder('a')
            ->join('a.categorie', 'v')
            ->andWhere('v.titre= :val')
            ->setParameter('val', 'Vente-Appart.')
            ->orderBy('a.adresse', 'ASC')
            ->getQuery()
            ->getResult();
    }

    public function findAscCreatedAt()
    {
        return $this->createQueryBuilder('a')
            ->orderBy('a.createdAt', 'ASC')
            ->getQuery()
            ->getResult();
    }

    //trier par auteur
    public function findAscAuteur()
    {
        return $this->createQueryBuilder('a')
            ->orderBy('a.auteur', 'ASC')
            ->getQuery()
            ->getResult();
    }

    //Lister les Articles par ordre ASC de Categorie
    public function findAllWithCategorie()
    {
        return $this->createQueryBuilder('a')
            ->select('a')
            ->join('a.categorie', 'c')
            ->orderBy('c.titre', 'ASC')
            ->getQuery()
            ->getResult();
    }

    //Lister les Articles par ordre ASC d'Agences
    public function findAllWithAgencyASC()
    {
        return $this->createQueryBuilder('a')
            ->select('a')
            ->join('a.agence', 'c')
            ->orderBy('c.adresse', 'ASC')
            ->getQuery()
            ->getResult();
    }

    //Lister les Articles par ordre ASC d'Agences
    public function findAllWithOwnerASC()
    {
        return $this->createQueryBuilder('a')
            ->select('a')
            ->join('a.agence', 'c')
            ->orderBy('c.adresse', 'ASC')
            ->getQuery()
            ->getResult();
    }

    //Lister les Articles par ordre ASC de proprio
    public function findAllWithGestionnaireASC()
    {
        return $this->createQueryBuilder('a')
            ->select('a')
            ->join('a.client', 'e')
            ->orderBy('e.id', 'ASC')
            ->getQuery()
            ->getResult();
    }

    public function terrainVendre()
    {
        return $this->createQueryBuilder('a')
            ->select('a')
            ->join('a.categorie', 'e')
            ->where('e.titre', 'Terrain à vendre')
            ->orderBy('a.updated', 'DESC')
            ->getQuery()
            ->getResult();
    }

    public function terrainLouer()
    {
        return $this->createQueryBuilder('a')
            ->select('a')
            ->join('a.categorie', 'e')
            ->where('e.titre', 'Terrain à louer')
            ->orderBy('a.updated', 'DESC')
            ->getQuery()
            ->getResult();
    }

//    /**
//     * @return Article[] Returns an array of Article objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('a.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Article
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}