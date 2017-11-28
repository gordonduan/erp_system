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
            <div class="crumb-list"><i class="icon-font">&#xe900;</i><a href="/erp/pages/home">Homepage</a><span class="crumb-step">&gt;</span><span class="crumb-name">Products</span></div>
        </div>
    <?= $this->Flash->render() ?>
        <div class="search-wrap">
            <div class="search-content">
              <?= $this->Form->create('product', ['url' => ['action' => 'search']])?>
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
                          <?= $this->Html->link('<i class="icon-font">&#xea0a;</i>'.__('Add Product', true), ['action' => 'add'], ['escape' => false]); ?>
                        <a id="batchDel" href="javascript:void(0)"><i class="icon-font">&#xe9ac;</i>Batch Delete</a>
                        <?= $this->Html->link('<i class="icon-font">&#xea2e;</i>'.__('Refresh', true), ['action' => 'refresh'], ['escape' => false]); ?>
                    </div>
                </div>
                <div class="result-content">
                    <table class="result-tab" width="100%">
                        <tr>
                          <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                          <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                          <th scope="col"><?= $this->Paginator->sort('description') ?></th>
                          <th scope="col"><?= $this->Paginator->sort('category_id') ?></th>
                          <th scope="col"><?= $this->Paginator->sort('price') ?></th>
                          <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                          <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                          <th scope="col" class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <tbody>
                            <?php foreach ($products as $product): ?>
                            <tr>
                              <td><?= $this->Number->format($product->id) ?></td>
                              <td><?= h($product->name) ?></td>
                              <td><?= h($product->description) ?></td>
                              <td><?= $product->has('category') ? $this->Html->link($product->category->name, ['controller' => 'Categories', 'action' => 'view', $product->category->id]) : '' ?></td>
                              <td><?= $this->Number->currency($product->price, 'USD') ?></td>
                              <td><?= h($product->created) ?></td>
                              <td><?= h($product->modified) ?></td>
                              <td class="actions">
                                  <?= $this->Html->link(__('View'), ['action' => 'view', $product->id]) ?>
                                  <?= $this->Html->link(__('Edit'), ['action' => 'edit', $product->id]) ?>
                                  <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $product->id], ['confirm' => __('Are you sure you want to delete # {0}?', $product->id)]) ?>
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
