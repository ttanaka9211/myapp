<?php

use Migrations\AbstractMigration;

class AddDeletedToProducts extends AbstractMigration
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
        $table->addColumn('deleted', 'datetime', [
            'default' => null,
            'null' => true,
            'after' => 'price'
        ]);
        $table->update();
    }

    public function down()
    {
        $table = $this->table('products');
        $table->removeColumn('deleted');
        $table->update;
    }
}