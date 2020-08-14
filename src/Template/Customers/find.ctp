<div class="customers find large-9 medium-8 columns content">
    <h3>Find customer</h3>
    <?= $msg ?>
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
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>last_name</th>
                <th>first_name</th>
                <th>telephone_number</th>
                <th>
                    <?_('Actions')?>
                </th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($customers as $customer) : ?>
            <tr>
                <td><?= h($customer->id) ?></td>
                <td><?= h($customer->last_name) ?></td>
                <td><?= h($customer->first_name) ?></td>
                <td><?= h($customer->telephone_number) ?></td>
                <td><?= $this->Html->Link(__('Order'), ['controller' => 'Sales', 'action' => 'add', $customer->id]) ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</div>