<table>
    <tr>
        <th>id</th>
        <th>name</th>
        <th>products_name</th>
        <th>price</th>
        <th>order_date_at</th>
        <th>created</th>
        <th>modified</th>
    </tr>
    <?php foreach ($sales as $sale) : ?>
    <tr>
        <td><?= $this->Number->format($sale->id) ?></td>
        <td><?= h($sale->customer_name) ?></td>
        <td><?= h($sale->products_name) ?></td>
        <td><?= h($sale->products_price) ?></td>
        <td><?= h($sale->order_date_at) ?></td>
        <td><?= h($sale->created) ?></td>
        <td><?= h($sale->modified) ?></td>
    </tr>
    <?php endforeach; ?>
</table>
<div class="paginator">
    <ul class="pagination">
        <?= $this->Paginator->first('<<') ?>
        <?= $this->Paginator->prev('<') ?>
        <?= $this->Paginator->numbers() ?>
        <?= $this->Paginator->next('>') ?>
        <?= $this->Paginator->last('>>') ?>
    </ul>
</div>