<?= $this->Html->css('//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css', ['block' => true]); ?>
<?= $this->Html->script('//code.jquery.com/jquery-1.12.4.js', ['block' => true]); ?>
<?= $this->Html->script('//code.jquery.com/ui/1.12.1/jquery-ui.js', ['block' => true]); ?>
<?= $this->Html->scriptStart(['block' => true]); ?>
  $( function() {
    $( "#datepicker" ).datepicker();
  } );
  $( function() {
    $( "#datepicker2" ).datepicker();
  } );
  <?= $this->Html->script('datepicker-ja.js', ['block' => true]); ?>
<?= $this->Html->scriptEnd(); ?>


<?=$this->Form->create('sales', ['url' => ['action' => 'aggregate'], 'type' => 'get']); ?>
 <?=$this->Form->control('from', ['type' => 'text', 'label' => '開始日', 'id' => 'datepicker']); ?>

 <?=$this->Form->control('to', ['type' => 'text', 'label' => '終了日', 'id' => 'datepicker2']); ?>


<?=$this->Form->submit('送信'); ?>
<?=$this->Form->end(); ?>
<table cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th scope="col">商品名</th>
            <?php foreach ($months as $month): ?>
            <th scope="col"><?= $month->format('Y/m'); ?></th>
            <?php endforeach; ?>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($accounts  as $account): ?>
        <tr>
            <td><?= h($account->product_name); ?></td>
            <?php foreach ($months as $month): ?>
            <td><?= $this->Number->format($account[$month->format('Y/m')]); ?></td>
            <?php endforeach; ?>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
