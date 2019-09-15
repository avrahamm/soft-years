<?php

namespace App\Controller;

use JMS\Serializer\SerializerInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use App\Entity\Year;

class YearController extends AbstractController
{
    /**
     * Creates class.
     *
     * YearController constructor.
     * @param EntityManagerInterface $em
     * @param SerializerInterface $serializer
     */
    public function __construct(EntityManagerInterface $em, SerializerInterface $serializer)
    {
        $this->em = $em;
        $this->serializer = $serializer;
    }

    /**
     * Writes welcome message.
     *
     * @Route("/index", name="index")
     * @return JsonResponse
     */
    public function index() :JsonResponse
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/YearController.php',
        ]);
    }

    /**
     * Return the year data.
     *
     * @Route("/years/{year}", name="yearData")
     * @param string $year
     * @return JsonResponse
     * @throws \Psr\Cache\InvalidArgumentException
     */
    public function getYearData(string $year) : JsonResponse
    {
        try {
            $yearData = $this->em->getRepository(Year::class)
                ->getYearData($year);
            $yearJsonData = $this->serializer->serialize($yearData, 'json');
        }
        catch (\Exception $ex ) {
            return new JsonResponse("Invalid data. ".$ex->getMessage());
        }
        $jsonResult = $this->json(['data' =>$yearJsonData]);
        return $jsonResult;
    }

    /**
     * Returns all years.
     *
     * @Route("/years", name="allYears")
     * @return JsonResponse
     * @throws \Psr\Cache\InvalidArgumentException
     */
    public function getAllYears() : JsonResponse
    {
        $allYears = $this->em
            ->getRepository(Year::class)
            ->findAllYears();
        return $this->json($allYears);
    }

    /** @var EntityManagerInterface  */
    private $em;

    /** @var SerializerInterface */
    private $serializer;
}
