<?php

use Migrations\AbstractSeed;

/**
 * Products seed.
 */
class ProductsSeed extends AbstractSeed
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
        $data = [
            [
                'name' => 'A',
                'price' => '2800',
                'delete_flag' => '1',
                'created' => $datetime,
                'modified' => $datetime
            ],
            [
                'name' => 'B',
                'price' => '4800',
                'delete_flag' => '1',
                'created' => $datetime,
                'modified' => $datetime
            ],
            [
                'name' => 'C',
                'price' => '1080',
                'delete_flag' => '1',
                'created' => $datetime,
                'modified' => $datetime
            ],
            [
                'name' => 'D',
                'price' => '6800',
                'delete_flag' => '1',
                'created' => $datetime,
                'modified' => $datetime
            ],
        ];

        $table = $this->table('products');
        $table->insert($data)->save();
    }
}