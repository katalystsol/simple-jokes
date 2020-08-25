<?php

namespace App\Repository;

use App\Entity\Joke;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\DBAL\DBALException;
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
            ->where('j.id = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getArrayResult();
    }

    /**
     * Return a random joke in array format.
     *
     * @param int $num
     *
     * @return array|null
     * @throws DBALException
     */
    public function getRandomJoke(int $num = 1): ?array
    {
        if ($num < 1) {
            return null;
        }

        $conn = $this->getEntityManager()->getConnection();
        $sql = "SELECT * FROM joke WHERE id IN (SELECT id FROM joke ORDER BY RANDOM() LIMIT ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(1, $num);
        $stmt->execute();

        return (1 === $num) ? $stmt->fetch() : $stmt->fetchAll();
    }

    /**
     * @param string $value
     * @return array Returns an array of Jokes in array format
     */
    public function findByJokeText($value): array
    {
        return $this->createQueryBuilder('j')
            ->where('j.joke LIKE :val')
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
