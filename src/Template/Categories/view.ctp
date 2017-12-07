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
            <div class="crumb-list"><i class="icon-font">&#xe900;</i><a href="/erp/pages/home">Homepage</a><span class="crumb-step">&gt;</span><a class="crumb-name" href="/erp/categories">Categories</a><span class="crumb-step">&gt;</span><span>View</span></div>

      </div>
        <?= $this->Flash->render() ?>
        <div class="result-wrap" >
            <div class="result-content">

                    <table class="insert-tab" width="100%">
                        <tbody>
                          <tr>
                            <th width="150">Parent Category：</th>
                            <td>
                              <?= $category->has('parent_category') ? $this->Html->link($category->parent_category->name, ['controller' => 'Categories', 'action' => 'view', $category->parent_category->id]) : '' ?>
                            </td>
                          </tr>
                          <tr>
                            <th><i class="require-red">*</i>Name：</th>
                              <td>
                                <?= $this->Form->control('name', ['value' => $category->name, 'label' => '', 'size' => '50','class' => 'common-text required', 'disabled' => true]);?>
                              </td>
                          </tr>
                          <tr>
                            <th>Description：</th>
                              <td>
                                <?= $this->Form->textarea('description', ['value' => $category->description, 'rows' => '10', 'style' => 'width:98%', 'cols' => '30', 'disabled' => true]);?>
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

                  <?php if (!empty($category->child_categories)): ?>
                <p style=margin:10px><?= __('Related Categories') ?></p>
                  <table class="result-tab" width="100%">
                    <tr>
                        <th scope="col"><?= __('Id') ?></th>
                        <th scope="col"><?= __('Parent Name') ?></th>
                        <th scope="col"><?= __('Name') ?></th>
                        <th scope="col"><?= __('Description') ?></th>
                        <th scope="col"><?= __('Created') ?></th>
                        <th scope="col"><?= __('Modified') ?></th>
                    </tr>
                      <tbody>

                        <?php foreach ($category->child_categories as $childCategories): ?>
                        <tr>
                            <td><?= h($childCategories->id) ?></td>
                            <td><?= $category->has('parent_category') ? $category->parent_category->name : '' ?></td">
                            <td><?= h($childCategories->name) ?></td>
                            <td><?= h($childCategories->description) ?></td>
                            <td><?= h($childCategories->created) ?></td>
                            <td><?= h($childCategories->modified) ?></td>
                        </tr>
                        <?php endforeach; ?>
                      </tbody>
                  </table>
                  <?php endif; ?>

                  <?php if (!empty($category->products)): ?>
                  <p style=margin:10px><?= __('Related Products') ?></p>
                  <table class="result-tab" width="100%">
                    <tr>
                        <th scope="col"><?= __('Id') ?></th>
                        <th scope="col"><?= __('Name') ?></th>
                        <th scope="col"><?= __('Description') ?></th>
                        <th scope="col"><?= __('Category Id') ?></th>
                        <th scope="col"><?= __('Price') ?></th>
                        <th scope="col"><?= __('Created') ?></th>
                        <th scope="col"><?= __('Modified') ?></th>
                    </tr>
                      <tbody>
                        <?php foreach ($category->products as $products): ?>
                        <tr>
                            <td><?= h($products->id) ?></td>
                            <td><?= h($products->name) ?></td>
                            <td><?= h($products->description) ?></td>
                            <td><?= h($products->category_id) ?></td>
                            <td><?= h($products->price) ?></td>
                            <td><?= h($products->created) ?></td>
                            <td><?= h($products->modified) ?></td>
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
