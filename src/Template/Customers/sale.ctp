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
    <?= $this->Form->create($client) ?>
    <fieldset>
        <legend><?= __('Add Customer') ?></legend>
        <?php
        echo $this->Form->control('customer_id', ['type' => 'hidden', 'value' => $client->id]);
        echo $this->Form->control('customer_name', ['value' => ($client->last_name . $client->first_name)]);
        echo $this->Form->control('product_id');
        echo $this->Form->control('product_name');
        echo $this->Form->control('product_price');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>