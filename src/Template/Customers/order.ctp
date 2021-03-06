<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Customer $customer
 */
?>
<div class="customers form large-9 medium-8 columns content">
    <?= $this->Form->create(
        $client,
        array('url' => array('controller' => 'products', 'action' => 'product'))
    ) ?>
    <fieldset>
        <legend><?= __('Add Customer') ?></legend>
        <?php
        echo $this->Form->control('customer_id', ['name' => 'customer_id', 'type' => 'hidden', 'value' => $client->id]);
        echo $this->Form->control('customer_name', ['name' => 'customer_name', 'value' => ($client->last_name . $client->first_name)]);
        echo $this->Form->control(
            'product_id',
            ['name' => 'product_id', 'type' => 'select', 'empty' => '選択して下さい', 'options' => $productsVaild]
        );
        //echo $this->Form->control('product_name', ['type' => 'hidden', 'value' => $product->name]);
        //echo $this->Form->control('product_price', ['value' => $product->price]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>