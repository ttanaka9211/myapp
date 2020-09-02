<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Sale $sale
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Sales'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Customers'), ['controller' => 'Customers', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Customer'), ['controller' => 'Customers', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Products'), ['controller' => 'Products', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Product'), ['controller' => 'Products', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="sales form large-9 medium-8 columns content">
    <?= $this->Form->create($sale) ?>
    <fieldset>
        <legend><?= __('Add Sale') ?></legend>
        <?php
<<<<<<< HEAD
        echo $this->Form->control($customer->id);
=======
        echo $this->Form->control('customer_id', ['options' => $customers, 'value' => 'name']);
>>>>>>> feature/add-product
        echo $this->Form->control('customer_name');
        echo $this->Form->control('product_id', ['options' => $products]);
        echo $this->Form->control('product_name');
        echo $this->Form->control('product_price');
        echo $this->Form->control('quantity');
        echo $this->Form->control('order_date_at');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>