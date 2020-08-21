<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Sale[]|\Cake\Collection\CollectionInterface $sales
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Sale'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Customers'), ['controller' => 'Customers', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Customer'), ['controller' => 'Customers', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Products'), ['controller' => 'Products', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Product'), ['controller' => 'Products', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="customers find large-9 medium-8 columns content">
    <h3>Find customer</h3>
    <?php echo $this->Form->create(
        null,
        ['valueSources' => 'query']
    ); ?>
    <fieldset>
        <?php
        //echo $this->Form->control(__('order_from'), ['type' => 'date']);
        //echo $this->Form->control(__('order_to'), ['type' => 'date']);
        echo $this->Form->control(__('Search'), ['type' => 'submit']);
        echo $this->Form->end();
        ?>
    </fieldset>
    <div class="sales index large-9 medium-8 columns content">
        <h3><?= __('Sales') ?></h3>
        <table cellpadding="0" cellspacing="0">
            <thead>
                <tr>
                    <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('customer_id') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('customer_name') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('product_id') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('product_name') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('product_price') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('quantity') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('order_date_at') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                    <th scope="col" class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($sales as $sale) : ?>
                <tr>
                    <td><?= $this->Number->format($sale->id) ?></td>
                    <td><?= $sale->has('customer') ? $this->Html->link($sale->customer->id, ['controller' => 'Customers', 'action' => 'view', $sale->customer->id]) : '' ?></td>
                    <td><?= h($sale->customer_name) ?></td>
                    <td><?= $sale->has('product') ? $this->Html->link($sale->product->name, ['controller' => 'Products', 'action' => 'view', $sale->product->id]) : '' ?></td>
                    <td><?= h($sale->product_name) ?></td>
                    <td><?= $this->Number->format($sale->product_price) ?></td>
                    <td><?= $this->Number->format($sale->quantity) ?></td>
                    <td><?= h($sale->order_date_at) ?></td>
                    <td><?= h($sale->created) ?></td>
                    <td><?= h($sale->modified) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $sale->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $sale->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $sale->id], ['confirm' => __('Are you sure you want to delete # {0}?', $sale->id)]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <div class="paginator">
            <ul class="pagination">
                <?= $this->Paginator->first('<< ' . __('first')) ?>
                <?= $this->Paginator->prev('< ' . __('previous')) ?>
                <?= $this->Paginator->numbers() ?>
                <?= $this->Paginator->next(__('next') . ' >') ?>
                <?= $this->Paginator->last(__('last') . ' >>') ?>
            </ul>
            <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
        </div>
    </div>