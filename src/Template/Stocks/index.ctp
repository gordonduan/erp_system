<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Order[]|\Cake\Collection\CollectionInterface $orders
 */
?>
<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Product[]|\Cake\Collection\CollectionInterface $products
 */
?>
<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Category[]|\Cake\Collection\CollectionInterface $categories
  * @var \App\Model\Entity\Category $category
 */
?>

<script>

function formsubmit()
{
  alert('Permissions to modify inventory are only granted to Admin!');
}
</script>

<div class="main-wrap">

        <div class="crumb-wrap">
            <div class="crumb-list"><i class="icon-font">&#xe900;</i><a href="/erp/pages/home">Homepage</a><span class="crumb-step">&gt;</span><span class="crumb-name">Stocks</span></div>
        </div>
        <div class="search-wrap">
            <div class="search-content">
            <!--   <form action="/erp/stocks/index" method="post">  -->
            <!--      <?= $this->Form->create($stocks, ['controller' => 'Stocks', 'action' => 'index']) ?> -->
            <!--  <?= $this->Form->create('stock', ['action' => 'index'])?> -->
                  <?= $this->Form->create('stock', ['url' => ['action' => 'search']])?>
                  <table class="search-tab">
                      <tr>
                          <th width="70">Name:</th>
                          <td><input class="common-text" placeholder="Name" name="keywords" value="" id="" type="text"></td>
                          <td><input class="btn btn-primary btn2" name="sub" value="Search" type="submit"></td>
                      </tr>
                  </table>
                <?= $this->Form->end() ?>
            <!--  </form> -->
            </div>
        </div>

        <div class="result-wrap" style="border-bottom: 0px">

                <div class="result-title">
                    <div class="result-list">
                      <a id="addstock" href="javascript:void(0)" onclick="formsubmit()"><i class="icon-font">&#xea0a;</i>Modify Stock</a>

                        <?= $this->Html->link('<i class="icon-font">&#xea2e;</i>'.__('Refresh', true), ['action' => 'refresh'], ['escape' => false]); ?>
                    </div>
                </div>
                <div class="result-content">
                    <table class="result-tab" width="100%">
                        <tr>
                              <th scope="col"><?= $this->Paginator->sort('product_id') ?></th>
                              <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                              <th scope="col"><?= $this->Paginator->sort('description') ?></th>
                              <th scope="col"><?= $this->Paginator->sort('quantity') ?></th>
                        </tr>
                        <tbody>
                            <?php foreach ($stocks as $stock): ?>
                            <tr>
                              <td><?= $this->Number->format($stock->product_id) ?></td>
                          <!--    <td><?= $stock->has('product') ? $this->Html->link($stock->product->name, ['controller' => 'Products', 'action' => 'view', $stock->product->id]) : '' ?></td> -->
                              <td><?= h($stock->name) ?></td>
                              <td><?= h($stock->description) ?></td>
                              <td><?= $this->Number->format($stock->quantity) ?></td>
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

          </div>
</div>

<!--
<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Stock[]|\Cake\Collection\CollectionInterface $stocks
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Stock'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Products'), ['controller' => 'Products', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Product'), ['controller' => 'Products', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="stocks index large-9 medium-8 columns content">
    <h3><?= __('Stocks') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('product_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('description') ?></th>
                <th scope="col"><?= $this->Paginator->sort('quantity') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($stocks as $stock): ?>
            <tr>
                <td><?= $this->Number->format($stock->id) ?></td>
                <td><?= $stock->has('product') ? $this->Html->link($stock->product->name, ['controller' => 'Products', 'action' => 'view', $stock->product->id]) : '' ?></td>
                <td><?= h($stock->name) ?></td>
                <td><?= h($stock->description) ?></td>
                <td><?= $this->Number->format($stock->quantity) ?></td>
                <td><?= h($stock->created) ?></td>
                <td><?= h($stock->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $stock->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $stock->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $stock->id], ['confirm' => __('Are you sure you want to delete # {0}?', $stock->id)]) ?>
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
-->
