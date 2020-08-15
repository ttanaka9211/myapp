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
    <?= $this->Form->create($customer) ?>
    <fieldset>
        <legend><?= __('Add Customer') ?></legend>
        <?php
        echo $this->Form->control('id', ['type' => 'hidden', 'value' => $customer->id]);
        echo $this->Form->control('last_name', ['value' => $customer->last_name]);
        echo $this->Form->control('first_name', ['value' => $customer->first_name]);
        echo $this->Form->control('telephone_number', ['value' => $customer->telephone_number]);
        echo $this->Form->control('mailaddress');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>