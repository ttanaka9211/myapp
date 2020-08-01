<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Request $request
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Request'), ['action' => 'edit', $request->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Request'), ['action' => 'delete', $request->id], ['confirm' => __('Are you sure you want to delete # {0}?', $request->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Requests'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Request'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Customers'), ['controller' => 'Customers', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Customer'), ['controller' => 'Customers', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="requests view large-9 medium-8 columns content">
    <h3><?= h($request->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Customer') ?></th>
            <td><?= $request->has('customer') ? $this->Html->link($request->customer->id, ['controller' => 'Customers', 'action' => 'view', $request->customer->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($request->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($request->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($request->modified) ?></td>
        </tr>
    </table>
    <h3><?= h($customer->title) ?></h3>
    <p>FirstName: <?= h($customer->first_name) ?></p>
    <p>LastName: <?= h($customer->last_name) ?></p>
    <p>TelephoneNumber: <?= h($customer->telephone_number) ?></p>
    <p>Mailaddress: <?= h($customer->mailaddress) ?></p>

    <p><?= $this->Html->link('Add Request', ['controller' => 'requests', 'action' => 'add', '?' => ['customer_id' => $customer->id]]) ?></p>

    <p>requests</p>
    <table>
        <tr>
            <th>Id</th>
        </tr>

        <?php foreach ($requests as $request) : ?>
        <tr>
            <td> <?= $this->Html->link($request->id, ['action' => 'view', $request->id]) ?> </td>
        </tr>
        <?php endforeach; ?>
    </table>
</div>