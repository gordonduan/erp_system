<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Category[]|\Cake\Collection\CollectionInterface $categories
  * @var \App\Model\Entity\Category $category
 */
?>


<?php $this->set('toParent' , 'Categories');?>

<div class="main-wrap">

        <div class="crumb-wrap">
            <div class="crumb-list"><i class="icon-font">&#xe900;</i><a href="#">Homepage</a><span class="crumb-step">&gt;</span><span class="crumb-name">Categories</span></div>
        </div>
        <div class="search-wrap">
            <div class="search-content">
                <form action="#" method="post">
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
                          <?= $this->Html->link('<i class="icon-font">&#xea0a;</i>'.__('Add Category', true), ['action' => 'add'], ['escape' => false]); ?>
                        <a id="batchDel" href="javascript:void(0)"><i class="icon-font">&#xe9ac;</i>Batch Delete</a>
                        <a id="updateOrd" href="javascript:void(0)"><i class="icon-font">&#xea2e;</i>Refresh</a>
                    </div>
                </div>
                <div class="result-content">
                    <table class="result-tab" width="100%">
                        <tr>
                            <th class="tc" width="5%"></th>
                            <th scope="col"><?= $this->Paginator->sort('Id') ?></th>
                            <th scope="col"><?= $this->Paginator->sort('Parent_Category') ?></th>
                            <th scope="col"><?= $this->Paginator->sort('Name') ?></th>
                            <th scope="col"><?= $this->Paginator->sort('Description') ?></th>
                            <th scope="col"><?= $this->Paginator->sort('Created') ?></th>
                            <th scope="col"><?= $this->Paginator->sort('Modified') ?></th>
                            <th scope="col" class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <tbody>
                            <?php foreach ($categories as $category): ?>
                            <tr>
                                <td class="tc"><input name="id[]" value="" type="checkbox"></td>
                                <td><?= $this->Number->format($category->id) ?></td>
                                <td><?= $category->has('parent_category') ? $this->Html->link($category->parent_category->name, ['controller' => 'Categories', 'action' => 'view', $category->parent_category->id]) : '' ?></td">
                                <td><?= h($category->name) ?></td>
                                <td><?= h($category->description) ?></td>
                                <td><?= h($category->created) ?></td>
                                <td><?= h($category->modified) ?></td>
                                <td class="actions">
                                    <?= $this->Html->link(__('View'), ['action' => 'view', $category->id]) ?>
                                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $category->id]) ?>
                                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $category->id], ['confirm' => __('Are you sure you want to delete # {0}?', $category->id)]) ?>
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
