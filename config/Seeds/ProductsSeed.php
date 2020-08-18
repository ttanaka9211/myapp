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
        $data = [
            [
                'id' => '1',
                'name' => 'A',
                'price' => '2800',
                'delete_flag' => '0',
                'created' => '2020-08-13 10:37:46',
                'modified' => '2020-08-13 10:37:46',
            ],
            [
                'id' => '2',
                'name' => 'B',
                'price' => '4800',
                'delete_flag' => '0',
                'created' => '2020-08-13 10:37:46',
                'modified' => '2020-08-13 10:37:46',
            ],
            [
                'id' => '3',
                'name' => 'C',
                'price' => '1080',
                'delete_flag' => '0',
                'created' => '2020-08-13 10:37:46',
                'modified' => '2020-08-13 10:37:46',
            ],
            [
                'id' => '4',
                'name' => 'D',
                'price' => '6800',
                'delete_flag' => '0',
                'created' => '2020-08-13 10:37:46',
                'modified' => '2020-08-13 10:37:46',
            ],
        ];

        $table = $this->table('products');
        $table->insert($data)->save();
    }
}
