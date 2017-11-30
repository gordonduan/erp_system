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

if($this->request->session()->read('search_key') != "")
{
   $search_key = $this->request->session()->read('search_key');
}
else
{
   $search_key = "";
}

<div class="main-wrap">

        <div class="crumb-wrap">
            <div class="crumb-list"><i class="icon-font">&#xe900;</i><a href="/erp/pages/home">Homepage</a><span class="crumb-step">&gt;</span><span class="crumb-name">Orders</span></div>
        </div>
    <?= $this->Flash->render() ?>
        <div class="search-wrap">
            <div class="search-content">
                
                
              <?= $this->Form->create('order', ['url' => ['action' => 'search']])?>
                    <table class="search-tab">
                        <tr>
                            <th width="70">Name:</th>
                            <td><input class="common-text" placeholder="Name" name="keywords" value="" id="" type="text"></td>
                            <td><input class="btn btn-primary btn2" name="sub" value="Search" type="submit"></td>
                        </tr>
                    </table>
                <?= $this->Form->end() ?>
            </div>
        </div>

        <div class="result-wrap" style="border-bottom: 0px">

                <div class="result-title">
                    <div class="result-list">
                          <?= $this->Html->link('<i class="icon-font">&#xea0a;</i>'.__('Add Order', true),['action' => 'add'], ['escape' => false]); ?>
                  <!--      <a id="batchDel" href="javascript:void(0)"><i class="icon-font">&#xe9ac;</i>Batch Delete</a> -->
                        <?= $this->Html->link('<i class="icon-font">&#xea2e;</i>'.__('Refresh', true), ['action' => 'refresh'], ['escape' => false]); ?>
                    </div>
                </div>
                <div class="result-content">
                    <table class="result-tab" width="100%">
                        <tr>
                              <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                              <th scope="col"><?= $this->Paginator->sort('product_id') ?></th>
                              <th scope="col"><?= $this->Paginator->sort('name') ?></th>

                              <th scope="col"><?= $this->Paginator->sort('quantity') ?></th>
                              <th scope="col"><?= $this->Paginator->sort('type') ?></th>
                              <th scope="col"><?= $this->Paginator->sort('status') ?></th>

                              <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                              <th scope="col" class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <tbody>
                            <?php foreach ($orders as $order): ?>
                            <tr>
                              <td><?= $this->Number->format($order->id) ?></td>
                              <td><?= $order->has('product') ? $this->Html->link($order->product->name, ['controller' => 'Products', 'action' => 'view', $order->product->id]) : '' ?></td>
                              <td><?= h($order->name) ?></td>

                              <td><?= $this->Number->format($order->quantity) ?></td>
                              <td><?php $output = ($order->type=='0')? 'Purchasing':'Sales'; echo $output; ?></td>
                              <td><?php $output = ($order->status=='0')? 'Not Finished':'Finished';echo $output; ?></td>

                              <td><?= h($order->modified) ?></td>
                              <td class="actions">
                                  <?= $this->Html->link(__('View'), ['action' => 'view', $order->id]) ?>
                                  <?php if ($order->status!='1') echo $this->Html->link(__('Edit'), ['action' => 'edit', $order->id]) ?>
                                  <?php if ($order->status!='1') echo $this->Form->postLink(__('Delete'), ['action' => 'delete', $order->id], ['confirm' => __('Are you sure you want to delete # {0}?', $order->id)]) ?>
                                  <?php if ($order->status!='1') echo $this->Form->postLink(__('Approve'), ['action' => 'approve', $order->id]) ?>
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

          </div>
</div>


<!--
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Order'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Products'), ['controller' => 'Products', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Product'), ['controller' => 'Products', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="orders index large-9 medium-8 columns content">
    <h3><?= __('Orders') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('product_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('description') ?></th>
                <th scope="col"><?= $this->Paginator->sort('quantity') ?></th>
                <th scope="col"><?= $this->Paginator->sort('type') ?></th>
                <th scope="col"><?= $this->Paginator->sort('status') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($orders as $order): ?>
            <tr>
                <td><?= $this->Number->format($order->id) ?></td>
                <td><?= $order->has('product') ? $this->Html->link($order->product->name, ['controller' => 'Products', 'action' => 'view', $order->product->id]) : '' ?></td>
                <td><?= h($order->name) ?></td>
                <td><?= h($order->description) ?></td>
                <td><?= $this->Number->format($order->quantity) ?></td>
                <td><?= h($order->type) ?></td>
                <td><?= h($order->status) ?></td>
                <td><?= h($order->created) ?></td>
                <td><?= h($order->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $order->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $order->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $order->id], ['confirm' => __('Are you sure you want to delete # {0}?', $order->id)]) ?>
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
