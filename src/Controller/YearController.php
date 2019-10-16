<?php

namespace App\Controller;

use JMS\Serializer\SerializerInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
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
     * @return Response
     */
    public function index() :Response
    {
        return $this->render("year/index.html.twig");
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
            $yearJsonData = $this->em->getRepository(Year::class)
                ->getYearData($year);
        }
        catch (\Exception $ex ) {
            return new JsonResponse("Invalid data. ".$ex->getMessage());
        }
        return $this->json(['data' =>$yearJsonData]);
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
        return $this->json(['data' => $allYears]);
    }

    /** @var EntityManagerInterface  */
    private $em;

    /** @var SerializerInterface */
    private $serializer;
}
