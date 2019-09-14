<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;

use App\Entity\Year;
use App\Entity\Category;

/**
 * To create sample data and store to database.
 *
 * Class AppFixtures
 * @package App\DataFixtures
 */
class AppFixtures extends Fixture
{
    const YEARS_NUM = 3;
    /**
     * Creates sample data.
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $this->faker = Factory::create();

        $this->createYears($manager);
        $this->createCategories($manager);
    }

    /**
     * Creates years.
     *
     * @param ObjectManager $manager
     */
    private function createYears(ObjectManager $manager)
    {
        for ($i = 0; $i < self::YEARS_NUM; $i++)
        {
            $year = new Year();
            $year->setYear($this->faker->year);
            $year->setCircle1($this->faker->numberBetween(20,90));
            $year->setCircle2($this->faker->numberBetween(40,90));
            $manager->persist($year);
        }
        $manager->flush();
    }

    /**
     * Creates categories.
     *
     * @param ObjectManager $manager
     */
    private function createCategories(ObjectManager $manager)
    {
        $years = $manager->getRepository(Year::class)
            ->findAll();

        foreach ($years as $year)
        {
            for( $j = 0; $j < mt_rand(2, 4); $j++)
            {
                $category = new Category();
                $category->setTitle($this->faker->unique()->text(16));
                $category->setValue(mt_rand(10, 100));
                $category->setMaximumValue(mt_rand(101, 200));
                $category->setYear($year);
                $manager->persist($category);
            }
            $manager->flush();
        }
    }

    /** @var Generator */
    protected $faker;
}
