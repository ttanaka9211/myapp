
<?=$this->Form->create('sales', ['url' => ['action' => 'aggregate'], 'type' => 'get']); ?>
<?=$this->Form->control('from', ['type' => 'text', 'label' => '開始日']); ?>
<?=$this->Form->control('to', ['type' => 'text', 'label' => '終了日']);
?>
<?=$this->Form->submit('送信'); ?>
<?=$this->Form->end(); ?>
<table cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th scope="col">カテゴリー</th>
            <?php foreach ($months as $month): ?>
            <th scope="col"><?= $month->format('Y/m'); ?></th>
            <?php endforeach; ?>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($accounts as $account): ?>
        <tr>
            <td><?= h($account->category->name); ?></td>
            <?php foreach ($months as $month): ?>
            <td><?= $this->Number->format($account[$month->format('Y/m')]); ?></td>
            <?php endforeach; ?>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
