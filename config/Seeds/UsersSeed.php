<?php

use Cake\Auth\DefaultPasswordHasher;
use Migrations\AbstractSeed;

/**
 * Users seed.
 */
class UsersSeed extends AbstractSeed
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

        for ($i = 0; $i < 20; $i++) {
            $data[] = [
                'username' => $faker->name,
                'password' => $this->_setPassword(123456),
                'role' => $faker->numberBetween($min = 2, $max = 4),
                'created' => $datetime,
                'modified' => $datetime
            ];

            $table = $this->table('users');
            $table->insert($data)->save();
        }
    }

    /**
     * ハッシュ化されたパスワードを返却する
     * @param $value
     * @return bool|string
     */
    protected function _setPassword($value)
    {
        $hasher = new DefaultPasswordHasher();
        return $hasher->hash($value);
    }
}