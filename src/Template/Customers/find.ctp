<div class="customers find large-9 medium-8 columns content">
    <h3>Find customer</h3>
    <?= $this->Form->create() ?>
    <fieldset>
        <?php
        echo $this->Form->input('first_name');
        echo $this->Form->input('last_name');
        echo $this->Form->input('telephone_number');
        echo $this->Form->button('Submit');
        echo $this->Form->end()
        ?>
    </fieldset>
    <div class="customers index large-9 medium-8 columns content">
        <h3><?= __('Customers') ?></h3>
        <table cellpadding="0" cellspacing="0">
            <thead>
                <tr>
                    <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('last_name') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('first_name') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('telephone_number') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('mailaddress') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                    <th scope="col" class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($customers as $customer) : ?>
                <tr>
                    <td><?= $this->Number->format($customer->id) ?></td>
                    <td><?= h($customer->last_name) ?></td>
                    <td><?= h($customer->first_name) ?></td>
                    <td><?= h($customer->telephone_number) ?></td>
                    <td><?= h($customer->mailaddress) ?></td>
                    <td><?= h($customer->created) ?></td>
                    <td><?= h($customer->modified) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $customer->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $customer->id]) ?>
                        <?= $this->Html->link(__('Order'), ['action' => 'order', $customer->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $customer->id], ['confirm' => __('Are you sure you want to delete # {0}?', $customer->id)]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <div class="paginator">
            <ul class="pagination">
                <?= $this->Paginator->first('<< ' . __('first')) ?>
                <?= $this->Paginator->prev('< ' . __('previous')) ?>
                <?= $this->Paginator->numbers() ?>
                <?= $this->Paginator->next(__('next') . ' >') ?>
                <?= $this->Paginator->last(__('last') . ' >>') ?>
            </ul>
            <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
        </div>
    </div>