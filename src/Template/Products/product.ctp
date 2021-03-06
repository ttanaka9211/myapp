<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Customer $customer
 */
?>
<div class="customers form large-9 medium-8 columns content">
    <?= $this->Form->create($product, array('url' => array('controller' => 'Sales', 'action' => 'sale'))) ?>
    <fieldset>
        <legend><?= __('Add Customer') ?></legend>
        <?php
        echo $this->Form->control('customer_id', ['type' => 'hidden', 'value' => $product->customer_id]);
        echo $this->Form->control('customer_name', ['value' => $product->customer_name]);
        echo $this->Form->control('product_id', ['type' => 'hidden', 'value' => $product->id]);
        echo $this->Form->control('product_name', ['value' => $product->name]);
        echo $this->Form->control('product_price', ['value' => $product->price]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>