<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Sale $sale
 */
?>
<div class="sales form large-9 medium-8 columns content">
    <?= $this->Form->create($sale) ?>
    <fieldset>
        <legend><?= __('Add Sale') ?></legend>
        <?php
        echo $this->Form->control('customer_id', ['options' => $customers, 'value' => 'name']);
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