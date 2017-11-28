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


<div class="main-wrap">

        <div class="crumb-wrap">
            <div class="crumb-list"><i class="icon-font">&#xe900;</i><a href="/erp/pages/home">Homepage</a><span class="crumb-step">&gt;</span><span class="crumb-name">Orders</span></div>
        </div>
        <div class="search-wrap">
            <div class="search-content">
              <?= $this->Form->create('order', ['url' => ['action' => 'search']])?>
                    <table class="search-tab">
                        <tr>
                            <th width="70">Category:</th>
                            <td><?= $this->Form->control('category_id', ['label' =>'', 'options' => $categories, 'empty' => true]);?></td>
                            <th width="70">Name:</th>
                            <td><input class="common-text" placeholder="Name" name="name" value="" id="" type="text"></td>
                            <th width="70">Date:</th>
                            <td><input type="date" class="common-text" name="salesdate"></td>
                            <td><input class="btn btn-primary btn2" name="sub" value="Search" type="submit"></td>
                        </tr>
                    </table>
                <?= $this->Form->end() ?>
            </div>
        </div>

        <div class="result-wrap" style="border-bottom: 0px">

                <div class="result-content">
                    <table class="result-tab" width="100%">
                        <tr>
                              <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                              <th scope="col"><?= $this->Paginator->sort('product_id') ?></th>
                              <th scope="col"><?= $this->Paginator->sort('name') ?></th>

                              <th scope="col"><?= $this->Paginator->sort('quantity') ?></th>
                              <th scope="col"><?= $this->Paginator->sort('price') ?></th>
                              <th scope="col"><?= $this->Paginator->sort('amount') ?></th>

                              <th scope="col"><?= $this->Paginator->sort('date') ?></th>
                          
                        </tr>
                        <tbody>
                            <?php foreach ($orders as $order): ?>
                            <tr>
                              <td><?= $this->Number->format($order->id) ?></td>
                              <td><?= $order->has('product') ? $this->Html->link($order->product->name, ['controller' => 'Products', 'action' => 'view', $order->product->id]) : '' ?></td>
                              <td><?= h($order->name) ?></td>

                              <td><?= $this->Number->format($order->quantity) ?></td>
                              <td><?= $this->Number->format($order->price) ?></td>
                              <td><?= $this->Number->format(0) ?></td>
                              <td><?= $order->modified ?></td>

                              
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