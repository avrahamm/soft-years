<?php

namespace App\Repository;

use JMS\Serializer\SerializerInterface;
use Symfony\Contracts\Cache\ItemInterface;
use Doctrine\Common\Persistence\ManagerRegistry;
use Symfony\Contracts\Cache\TagAwareCacheInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

use App\Entity\Year;

/**
 * YearRepository uses cache to  fetch from database.
 * JMSSerializer is used to serialize to json.
 */
class YearRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry, TagAwareCacheInterface $cache,
                                SerializerInterface $serializer)
    {
        parent::__construct($registry, Year::class);
        $this->cache = $cache;
        $this->serializer = $serializer;
    }

    /**
     * Returns the year data.
     *
     * @param $year
     * @return mixed
     * @throws \Psr\Cache\InvalidArgumentException
     */
    public function getYearData(string $year)
    {
        $yearJsonData = $this->cache->get("yearData{$year}", function (ItemInterface $item) use ($year) {
            $item->expiresAfter(3600);
            $yearData = $this->findOneBy(['year'=>$year]);
            $yearJsonData = $this->serializer->serialize($yearData, 'json');
            return $yearJsonData;
        });
        return $yearJsonData;
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

    /** @var SerializerInterface */
    private $serializer;
}
