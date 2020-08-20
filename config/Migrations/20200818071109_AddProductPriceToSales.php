<?php

use Migrations\AbstractMigration;

class AddProductPriceToSales extends AbstractMigration
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
        $table->addColumn('product_price', 'integer', [
            'default' => null,
            'limit' => 3,
            'null' => false,
        ]);
        $table->update();
    }

    public function down()
    {
        $table = $this->table('sales');
        $table->removeColumn('product_price');
        $table->update();
    }
}