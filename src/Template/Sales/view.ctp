<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Sale $sale
 */
?>
<div class="sales view large-9 medium-8 columns content">
    <h3><?= h($sale->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Customer') ?></th>
            <td><?= $sale->has('customer') ? $this->Html->link($sale->customer->id, ['controller' => 'Customers', 'action' => 'view', $sale->customer->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Customer Name') ?></th>
            <td><?= h($sale->customer_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Product') ?></th>
            <td><?= $sale->has('product') ? $this->Html->link($sale->product->name, ['controller' => 'Products', 'action' => 'view', $sale->product->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Product Name') ?></th>
            <td><?= h($sale->product_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($sale->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Product Price') ?></th>
            <td><?= $this->Number->format($sale->product_price) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Quantity') ?></th>
            <td><?= $this->Number->format($sale->quantity) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Order Date At') ?></th>
            <td><?= h($sale->order_date_at) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($sale->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($sale->modified) ?></td>
        </tr>
    </table>
</div>