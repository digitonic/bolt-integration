<?php

namespace Digitonic\Bolt\Testing;

use Faker\Generator;
use Illuminate\Support\Facades\DB;

class BoltEnvBuilder
{
    /**
     * @var Generator
     */
    protected $faker;

    /**
     * BoltBuilder constructor.
     */
    public function __construct()
    {
        $this->faker = resolve(Generator::class);
    }

    /**
     * @param string $tableName
     * @return bool
     */
    public function createTenancyTable(string $tableName): bool
    {
        return DB::connection('bolt')
            ->statement(
                "CREATE TABLE if not exists '$tableName' (
                      'uuid' varchar(255) NOT NULL,
                      'mobile' varchar(255) NOT NULL,
                      'unsubscribed_at' varchar(255) NOT NULL,
                      'created_at' timestamp NULL DEFAULT NULL,
                      'updated_at' timestamp NULL DEFAULT NULL
                  )"
            );
    }

    /**
     * @param string $tableName
     * @param string $phoneNumber
     * @return bool
     */
    public function insertOptout(string $tableName, string $phoneNumber): bool
    {
        return DB::connection('bolt')->table($tableName)->insert([
            'uuid' => $this->faker->uuid(),
            'mobile' => $phoneNumber,
            'unsubscribed_at' => $this->faker->dateTime(),
            'created_at' => $this->faker->dateTime(),
            'updated_at' => $this->faker->dateTime()
        ]);
    }

    /**
     * @param string $tableName
     * @return array
     */
    public function getOptouts(string $tableName): array
    {
        return DB::connection('bolt')
            ->select("select mobile from '$tableName'");
    }
}
