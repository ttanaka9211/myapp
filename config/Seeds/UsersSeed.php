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
        $data = [
            [
                'username' => 'test01',
                'email' => 'test01@test.com',
                'password' => $this->_setPassword(123456),
                'role' => 'admin',
                'created' => $datetime,
                'modified' => $datetime,
            ],
            [
                'username' => 'test02',
                'email' => 'test02@test.com',
                'password' => $this->_setPassword(123456),
                'role' => 'user',
                'created' => $datetime,
                'modified' => $datetime,
            ],
            [
                'username' => 'test03',
                'email' => 'test03@test.com',
                'password' => $this->_setPassword(123456),
                'role' => 'user',
                'created' => $datetime,
                'modified' => $datetime,
            ],

        ];

        $table = $this->table('users');
        $table->insert($data)->save();
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