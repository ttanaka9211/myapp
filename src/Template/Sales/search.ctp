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
    <?= $this->Form->create(); ?>
    <fieldset>
        <?php
        //echo $this->Form->control(__('customer_name'));
        $this->Form->setTemplates([
            'dateWidget' => '<input type="Date" name="start" value="{{value}}">'
        ]);
        echo $this->Form->control('start', [
            'type' => 'date',
            'name' => 'start',


        ]);
        $this->Form->setTemplates([
            'dateWidget' => '<input type="Date" name="end" value="{{value}}">'
        ]);
        echo $this->Form->control(__('end'), ['type' => 'date']);
        echo $this->Form->control(__('Search'), ['type' => 'submit']);
        echo $this->Form->end();
        ?>
    </fieldset>
    <div class="sales index large-9 medium-8 columns content">
        <h3></h3>
        <table cellpadding="0" cellspacing="0">
            <thead>
                <tr>
                    <th>id</th>
                    <th>customer_name</th>
                    <th>product_name</th>
                    <th>product_price</th>
                    <th>order_date_at</th>
                    <th>created</th>
                    <th>modified</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($sales as $sale) : ?>
                <tr>
                    <td><?= h($sale->id) ?></td>
                    <td><?= h($sale->customer_name) ?></td>
                    <td><?= h($sale->product_name) ?></td>
                    <td><?= h($sale->product_price) ?></td>
                    <td><?= h($sale->order_date_at) ?></td>
                    <td><?= h($sale->created) ?></td>
                    <td><?= h($sale->modified) ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>