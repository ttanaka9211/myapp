<?php

use Migrations\AbstractMigration;

class RemoveQuantityFromSales extends AbstractMigration
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
        $table = $this->table('sales');
        $table->removeColumn('quantity');
        $table->update();
    }
    public function down()
    {
        $table = $this->table('sales');
        $table->addColumn('quantity', 'integer', [
            'default' => null,
            'after' => 'product_price',
            'limit' => 3,
            'null' => false,
        ]);
        $table->update();
    }
}