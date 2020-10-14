<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Sale $sale
 */
?>
<div class="sales form large-9 medium-8 columns content">
    <?= $this->Form->create($sale) ?>
    <fieldset>
        <legend><?= __('Edit Sale') ?></legend>
        <?php
        echo $this->Form->control('customer_id', ['options' => $customers]);
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