<?php

use Migrations\AbstractMigration;

class AddEmailToUser extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     * @return void
     */
    public function up()
    {
        $table = $this->table('users');
        $table->addColumn('email', 'string', [
            'default' => null,
            'limit' => 255,
            'after' => 'username',
            'null' => true,
        ]);
        $table->update();
    }
    public function down()
    {
        $table = $this->table('users');
        $table->removeColumn('email');
        $table->update();
    }
}