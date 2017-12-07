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
            <div class="crumb-list"><i class="icon-font">&#xe900;</i><a href="/erp/pages/home">Homepage</a><span class="crumb-step">&gt;</span><span class="crumb-name">Reports</span></div>
        </div>
        <div class="search-wrap">
            <div class="search-content">
            <!--   <form action="/erp/stocks/index" method="post">  -->
            <!--      <?= $this->Form->create('sales', ['controller' => 'Sales', 'action' => 'index']) ?> -->
            <!--  <?= $this->Form->create('sales', ['action' => 'index'])?> -->
                  <?= $this->Form->create('sales', ['url' => ['action' => 'search']])?>
                  <table class="search-tab">
                      <tr>
                          <th width="80">Categories:</th>
                          <td><?= $this->Form->control('category_id', ['options' => $categories, 'label' => '', 'empty' => true]);?></td>
                          <th width="70">Products:</th>
                          <td><?= $this->Form->control('product_id', ['options' => $products, 'label' => '', 'empty' => true]);?></td>                         
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
                      
                        <?= $this->Html->link('<i class="icon-font">&#xea2e;</i>'.__('Refresh', true), ['action' => 'refresh'], ['escape' => false]); ?>
                    </div>
                </div>
                <div class="result-content">
                    <table class="result-tab" width="100%">
                        <tr>
                                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('product_id') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('category_id') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('description') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('quantity') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('price') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('amount') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('date') ?></th>
                     <!--       <th scope="col" class="actions"><?= __('Actions') ?></th> -->
                        </tr>
                        <tbody>
                            <?php foreach ($sales as $sale): ?>
                            <tr>
                              <td><?= $this->Number->format($sale->id) ?></td>
                                <td><?= $sale->has('product') ? $this->Html->link($sale->product->name, ['controller' => 'Products', 'action' => 'view', $sale->product->id]) : '' ?></td>
                                <td><?= $sale->has('category') ? $this->Html->link($sale->category->name, ['controller' => 'Categories', 'action' => 'view', $sale->category->id]) : '' ?></td>
                                <td><?= h($sale->name) ?></td>
                                <td><?= h($sale->description) ?></td>
                                <td><?= $this->Number->format($sale->quantity) ?></td>
                                <td><?= $this->Number->format($sale->price) ?></td>
                                <td><?= $this->Number->format($sale->amount) ?></td>
                                <td><?= h($sale->date) ?></td>
         <!--       <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $sale->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $sale->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $sale->id], ['confirm' => __('Are you sure you want to delete # {0}?', $sale->id)]) ?>
                </td>  -->
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
    $(document).ready(function(){
    $("#product").change(function(){
    $.ajax({
    type: "POST",
    url: "<?= $this->Url->build(['controller'=>'Sales', 'action'=>'categoryfilter']) ?>",
    data: {productid: $(this).val()},
    dataType: 'json',
    success: function(data) {
        $("#category").empty();
        $("#category").append("<option value=''></option>"); 
        for (var i in data) {  
             $("#category").append("<option value='"+i+"'>"+ data[i]+ "</option>");  
        } 
    }
    });
    });
    -->

<!--
<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Sale[]|\Cake\Collection\CollectionInterface $sales
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Sale'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Products'), ['controller' => 'Products', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Product'), ['controller' => 'Products', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Categories'), ['controller' => 'Categories', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Category'), ['controller' => 'Categories', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="sales index large-9 medium-8 columns content">
    <h3><?= __('Sales') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('product_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('category_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('description') ?></th>
                <th scope="col"><?= $this->Paginator->sort('quantity') ?></th>
                <th scope="col"><?= $this->Paginator->sort('price') ?></th>
                <th scope="col"><?= $this->Paginator->sort('amount') ?></th>
                <th scope="col"><?= $this->Paginator->sort('date') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($sales as $sale): ?>
            <tr>
                <td><?= $this->Number->format($sale->id) ?></td>
                <td><?= $sale->has('product') ? $this->Html->link($sale->product->name, ['controller' => 'Products', 'action' => 'view', $sale->product->id]) : '' ?></td>
                <td><?= $sale->has('category') ? $this->Html->link($sale->category->name, ['controller' => 'Categories', 'action' => 'view', $sale->category->id]) : '' ?></td>
                <td><?= h($sale->name) ?></td>
                <td><?= h($sale->description) ?></td>
                <td><?= $this->Number->format($sale->quantity) ?></td>
                <td><?= $this->Number->format($sale->price) ?></td>
                <td><?= $this->Number->format($sale->amount) ?></td>
                <td><?= h($sale->date) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $sale->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $sale->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $sale->id], ['confirm' => __('Are you sure you want to delete # {0}?', $sale->id)]) ?>
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