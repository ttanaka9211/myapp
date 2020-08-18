<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Customer $customer
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Customers'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="customers form large-9 medium-8 columns content">
    <?= $this->Form->create($sale, array('url' => array('action' => 'sale'))) ?>
    <fieldset>
        <legend><?= __('Add Customer') ?></legend>
        <?php
        echo $this->Form->control('customer_id', ['type' => 'hidden', 'value' => $sale->customer_id]);
        echo $this->Form->control('customer_name', ['value' => $sale->customer_name]);
        echo $this->Form->control('product_id', ['type' => 'text', 'value' => $sale->product_id]);
        echo $this->Form->control('product_name', ['value' => $sale->product_name]);
        echo $this->Form->control('product_price', ['value' => $sale->product_price]);
        echo $this->Form->control(
            'visit_date',
            [
                'label' => '受注日',
                'type' => 'date',
                'dateFormat' => 'YMD',
                'monthNames' => false,
                'maxYear' => date('Y'),
                'minYear' => date('Y') - 10,
                'empty' => '---'
            ]
        );
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>