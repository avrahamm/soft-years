<?php

namespace App\Repository;

use Symfony\Contracts\Cache\ItemInterface;
use Doctrine\Common\Persistence\ManagerRegistry;
use Symfony\Contracts\Cache\TagAwareCacheInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

use App\Entity\Year;

/**
 * @method Year|null find($id, $lockMode = null, $lockVersion = null)
 * @method Year|null findOneBy(array $criteria, array $orderBy = null)
 * @method Year[]    findAll()
 * @method Year[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class YearRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry, TagAwareCacheInterface $cache)
    {
        parent::__construct($registry, Year::class);
        $this->cache = $cache;
    }

    /**
     * Returns the year data.
     *
     * @param $year
     * @return mixed
     * @throws \Psr\Cache\InvalidArgumentException
     */
    public function getYearData($year)
    {
        $yearData = $this->cache->get("yearData{$year}", function (ItemInterface $item) use ($year) {
            $item->expiresAfter(3600);
            return $this->findOneBy(['year'=>$year]);
        });
        return $yearData;
    }

    /**
     * Returns all years.
     *
     * @return array of Objects like {"year": "1983"}
     * @throws \Psr\Cache\InvalidArgumentException never happens
     */
    public function findAllYears() : array
    {
        $allYears = $this->cache->get('allYears', function (ItemInterface $item) {
            $item->expiresAfter(3600);
            return $this->createQueryBuilder('y')
                ->select('y.year')
                ->orderBy('y.year', 'ASC')
                ->setMaxResults(10)
                ->getQuery()
                ->getResult()
                ;
        });
        return $allYears;
    }

    /** @var TagAwareCacheInterface */
    private $cache;
}
