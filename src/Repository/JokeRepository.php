<?php

namespace App\Repository;

use App\Entity\Joke;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Joke|null find($id, $lockMode = null, $lockVersion = null)
 * @method Joke|null findOneBy(array $criteria, array $orderBy = null)
 * @method Joke[]    findAll()
 * @method Joke[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class JokeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Joke::class);
    }

    /**
     * Returns an array of jokes in array format.
     * @return array
     */
    public function getAll(): array
    {
        $builder = $this->createQueryBuilder('u');

        return $builder->getQuery()->getArrayResult();
    }

    /**
     * Returns specific joke in array format.
     *
     * @param int $id
     *
     * @return array
     */
    public function getById(int $id): array
    {
        return $this->createQueryBuilder('j')
            ->andWhere('j.id = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getArrayResult();
    }

    public function getRandomJoke()
    {

    }

    /**
     * @param string $value
     * @return array Returns an array of Jokes in array format
     */
    public function findByJokeText($value): array
    {
        return $this->createQueryBuilder('j')
            ->andWhere('j.joke LIKE :val')
            ->setParameter('val', $value)
            ->orderBy('j.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getArrayResult();
    }

    /*
    public function findOneBySomeField($value): ?Joke
    {
        return $this->createQueryBuilder('j')
            ->andWhere('j.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
