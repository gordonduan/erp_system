<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Product $product
 */
?>

<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Category $category
 */
?>

<div class="container clearfix">

    <!--/sidebar-->
    <div class="main-wrap">

        <div class="crumb-wrap">
            <div class="crumb-list"><i class="icon-font">&#xe900;</i><a href="#">Homepage</a><span class="crumb-step">&gt;</span><a class="crumb-name" href="/jscss/admin/design/">Orders</a><span class="crumb-step">&gt;</span><span>Add</span></div>
        </div>
        <div class="result-wrap" style="border-bottom: 0px">
            <div class="result-content">
              <?= $this->Form->create($order) ?>
                    <table class="insert-tab" width="100%">
                        <tbody>
                          <tr>
                            <th width="150">Product：</th>
                            <td>
                                <?= $this->Form->control('product_id', ['label' =>'', 'options' => $products, 'empty' => true]);?>
                            </td>
                          </tr>
                          <tr>
                            <th><i class="require-red">*</i>Name：</th>
                              <td>
                                <?= $this->Form->text('name', ['value' => $order->name, 'size' => '50',  'class' => 'common-text required']);?>
                              </td>
                          </tr>

                          <tr>
                            <th>Description：</th>
                              <td>
                                <?= $this->Form->textarea('description', ['rows' => '10', 'style' => 'width:98%', 'cols' => '30']);?>
                              </td>
                          </tr>
                          <tr>
                            <th>Quantity：</th>
                              <td>
                                <?= $this->Form->control('quantity',['label' =>'',])?>
                              </td>
                          </tr>

                          <tr>
                            <th>Order Type：</th>
                              <td>
                                <select name="type">
                                  <option value="">(choose one)</option>
                                  <option value="1">Purchasing Order</option>
                                  <option value="2">Sales Order</option>
                              </td>
                          </tr>
                          <tr>
                              <th>Order Status：</th>
                              <td>
                                <select name="status" disabled="disabled">
                                  <option value="">(choose one)</option>
                                  <option value="1">Finished</option>
                                  <option value="2" selected = "selected" >Not Finished</option>
                              </td>
                          </tr>

                            <tr>
                                <th></th>
                                <td>
                                    <?= $this->Form->button(__('Submit'),['class' => 'btn btn-primary btn6 mr10']) ?>
                                    <?= $this->html->link('Back', ['action'=>'index'], ['class' => 'btn btn6', 'style' => 'width:100px']);?>
                                </td>
                            </tr>

                        </tbody>
                      </table>
                  <?= $this->Form->end() ?>
            </div>
        </div>

    </div>
    <!--/main-->
</div>





<!--
<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Order $order
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $order->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $order->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Orders'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Products'), ['controller' => 'Products', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Product'), ['controller' => 'Products', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="orders form large-9 medium-8 columns content">
    <?= $this->Form->create($order) ?>
    <fieldset>
        <legend><?= __('Edit Order') ?></legend>
        <?php
            echo $this->Form->control('product_id', ['options' => $products, 'empty' => true]);
            echo $this->Form->control('name');
            echo $this->Form->control('description');
            echo $this->Form->control('quantity');
            echo $this->Form->control('type');
            echo $this->Form->control('status');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
-->
