<?php

use Migrations\AbstractMigration;

class AddDeleteFlagToProducts extends AbstractMigration
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
        $table = $this->table('products');
        $table->addColumn('delete_flag', 'integer', [
            'default' => null,
            'limit' => 1,
            'after' => 'price',
            'null' => false,
        ]);
        $table->update();
    }

    public function down()
    {
        $table = $this->table('products');
        $table->removeColumn('delete_flag');
        $table->update();
    }
}