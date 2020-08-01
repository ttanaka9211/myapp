<?php

use Migrations\AbstractSeed;

/**
 * Customers seed.
 */
class CustomersSeed extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeds is available here:
     * https://book.cakephp.org/phinx/0/en/seeding.html
     *
     * @return void
     */
    public function run()
    {
        $datetime = date('Y-m-d H:i:s');

        $faker = Faker\Factory::create('ja_JP');

        for ($i = 0; $i < 100; $i++) {
            $data[] = [
                'first_name' => $faker->firstName,
                'last_name' => $faker->lastName,
                'telephone_number' => $faker->phoneNumber,
                'mailaddress' => $faker->email,
                'created' => $datetime,
                'modified' => $datetime
            ];

            $table = $this->table('customers');
            $table->insert($data)->save();
        }
    }
}