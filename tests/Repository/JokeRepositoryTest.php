<?php
/**
 * @author  donaldcranford
 * @created 8/24/20 6:00 PM
 */

namespace App\Tests\Repository;

use App\Entity\Joke;
use App\Repository\JokeRepository;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class JokeRepositoryTest extends KernelTestCase
{
    /**
     * @var EntityManager
     */
    private $entityManager;

    /**
     * @TODO automate running the migration and loading fixtures
     */
    protected function setUp(): void
    {
        $kernel = self::bootKernel();

        $this->entityManager = $kernel->getContainer()
            ->get('doctrine')
            ->getManager();
    }

    /** @test */
    public function it_returns_all_jokes_as_array_of_arrays()
    {
        $jokes = $this->entityManager
            ->getRepository(Joke::class)
            ->getAll();

        $this->assertIsArray($jokes);

        foreach ($jokes as $joke) {
            $this->assertIsArray($joke);
        }

        $expectedCount = 97;
        $this->assertCount($expectedCount, $jokes);
    }

    protected function tearDown(): void
    {
        parent::tearDown();

        // doing this is recommended to avoid memory leaks
        $this->entityManager->close();
        $this->entityManager = null;
    }
}
