<?php

use Migrations\AbstractMigration;

class ChangeOrderDateAtToSales extends AbstractMigration
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
        $table->changeColumn('order_date_at', 'date', [
            'default' => null,
            'null' => false,
        ]);
        $table->update();
    }

    public function down()
    {
        $table = $this->table('sales');
        $table->changeColumn('order_date_at', 'datetime', [
            'default' => null,
            'null' => false,
        ]);
    }
}