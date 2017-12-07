<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Category $category
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
            <div class="crumb-list"><i class="icon-font">&#xe900;</i><a href="/erp/pages/home">Homepage</a><span class="crumb-step">&gt;</span><a class="crumb-name" href="/erp/products">Products</a><span class="crumb-step">&gt;</span><span>View</span></div>
      </div>
        <?= $this->Flash->render() ?>
        <div class="result-wrap" >
            <div class="result-content">

                    <table class="insert-tab" width="100%">
                        <tbody>
                          <tr>
                            <th width="150">Parent Category：</th>
                            <td>
                              <?= $product->has('category') ? $this->Html->link($product->category->name, ['controller' => 'Categories', 'action' => 'view', $product->category->id]) : '' ?>
                            </td>
                          </tr>
                          <tr>
                            <th><i class="require-red">*</i>Name：</th>
                              <td>
                                <?= $this->Form->text('name', ['value' => $product->name, 'size' => '50',  'class' => 'common-text required', 'disabled' => true]);?>
                              </td>
                          </tr>

                          <tr>
                            <th>Price：</th>
                              <td>
                                <?= $this->Form->control('price',['value' => $product->price, 'label' =>'','disabled' => true])?>
                              </td>
                          </tr>


                          <tr>
                            <th>Description：</th>
                              <td>
                                <?= $this->Form->textarea('description', ['value' => $product->description, 'rows' => '10', 'style' => 'width:98%', 'cols' => '30','disabled' => true]);?>
                              </td>
                          </tr>
                            <tr>
                                <th></th>
                                <td>
                                    <?= $this->html->link('Back', ['action'=>'index'], ['class' => 'btn btn6', 'style' => 'width:100px']);?>
                                </td>
                            </tr>
                        </tbody>
                      </table>
            </div>
        </div>


      <div class="result-wrap"  style="border-bottom: 0px">

              <div class="result-content">

                  <?php if (!empty($product->orders)): ?>
                <p style=margin:10px><?= __('Related Orders') ?></p>
                  <table class="result-tab" width="100%">
                    <tr>
                      <th scope="col"><?= __('Id') ?></th>
                      <th scope="col"><?= __('Product Id') ?></th>
                      <th scope="col"><?= __('Name') ?></th>
                      <th scope="col"><?= __('Description') ?></th>
                      <th scope="col"><?= __('Quantity') ?></th>
                      <th scope="col"><?= __('Type') ?></th>
                      <th scope="col"><?= __('Status') ?></th>
                      <th scope="col"><?= __('Created') ?></th>
                      <th scope="col"><?= __('Modified') ?></th>
                    </tr>
                      <tbody>

                        <?php foreach ($product->orders as $orders): ?>
                        <tr>
                          <td><?= h($orders->id) ?></td>
                          <td><?= h($orders->product_id) ?></td>
                          <td><?= h($orders->name) ?></td>
                          <td><?= h($orders->description) ?></td>
                          <td><?= h($orders->quantity) ?></td>
                          <td><?php $output = ($orders->type=='0')? 'Purchasing':'Sales'; echo $output; ?></td>
                          <td><?php $output = ($orders->status=='0')? 'Not Finished':'Finished';echo $output; ?></td>
                          <td><?= h($orders->created) ?></td>
                          <td><?= h($orders->modified) ?></td>
                        </tr>
                        <?php endforeach; ?>
                      </tbody>
                  </table>
                  <?php endif; ?>

                  <?php if (!empty($product->stocks)): ?>
                  <p style=margin:10px><?= __('Related Stock') ?></p>
                  <table class="result-tab" width="100%">
                    <tr>
                      <th scope="col"><?= __('Product Id') ?></th>
                      <th scope="col"><?= __('Name') ?></th>
                      <th scope="col"><?= __('Description') ?></th>
                      <th scope="col"><?= __('Quantity') ?></th>
                      <th scope="col"><?= __('Created') ?></th>
                      <th scope="col"><?= __('Modified') ?></th>

                    </tr>
                      <tbody>
                        <?php foreach ($product->stocks as $stocks): ?>
                        <tr>
                          <td><?= h($stocks->product_id) ?></td>
                          <td><?= h($stocks->name) ?></td>
                          <td><?= h($stocks->description) ?></td>
                          <td><?= h($stocks->quantity) ?></td>
                          <td><?= h($stocks->created) ?></td>
                          <td><?= h($stocks->modified) ?></td>

                        </tr>
                        <?php endforeach; ?>
                      </tbody>
                  </table>
                <?php endif; ?>
              </div>
        </div>
    <!--/main-->
</div>

</div>
