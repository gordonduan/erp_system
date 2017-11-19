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
            <div class="crumb-list"><i class="icon-font">&#xe900;</i><a href="#">Homepage</a><span class="crumb-step">&gt;</span><span class="crumb-name">Stocks</span></div>
        </div>
        <div class="search-wrap">
            <div class="search-content">
              <form action="search" method="post">
                  <table class="search-tab">
                      <tr>
                          <th width="70">Name:</th>
                          <td><input class="common-text" placeholder="Name" name="keywords" value="" id="" type="text"></td>
                          <td><input class="btn btn-primary btn2" name="sub" value="Search" type="submit"></td>
                      </tr>
                  </table>
              </form>
            </div>
        </div>

        <div class="result-wrap" style="border-bottom: 0px">

                <div class="result-title">
                    <div class="result-list">

                        <a id="updateOrd" href="javascript:void(0)"><i class="icon-font">&#xea2e;</i>Refresh</a>
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
                              <td><?= $stock->has('product') ? $this->Html->link($stock->product->name, ['controller' => 'Products', 'action' => 'view', $stock->product->id]) : '' ?></td>
                              <td><?= h($stock->description) ?></td>
                              <td><?= $this->Number->format($stock->quantity) ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>

                </div>

          </div>
</div>
