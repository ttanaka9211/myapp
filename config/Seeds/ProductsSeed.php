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
                'product_name' => 'A',
                'unit_price' => '2800',
                'created' => $datetime,
                'modified' => $datetime
            ],
            [
                'product_name' => 'B',
                'unit_price' => '4800',
                'created' => $datetime,
                'modified' => $datetime
            ],
            [
                'product_name' => 'C',
                'unit_price' => '1080',
                'created' => $datetime,
                'modified' => $datetime
            ],
            [
                'product_name' => 'D',
                'unit_price' => '6800',
                'created' => $datetime,
                'modified' => $datetime
            ],
        ];

        $table = $this->table('products');
        $table->insert($data)->save();
    }
}