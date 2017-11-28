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
  var a = document.getElementsByName("id[]");
  var n = a.length;
  var k = 0;
  for (var i=0; i<n; i++){
       if(a[i].checked){
           k = 1;
       }
   }
       if(k==0){
       alert("Please select at least one record!");
       return;
   }
  document.getElementById("batchdelform").submit();
}
</script>

<?php $this->set('toParent' , 'Categories');?>

<div class="main-wrap">

        <div class="crumb-wrap">
            <div class="crumb-list"><i class="icon-font">&#xe900;</i><a href="/erp/pages/home">Homepage</a><span class="crumb-step">&gt;</span><span class="crumb-name">Categories</span></div>

        </div>
    <?= $this->Flash->render() ?>
        <div class="search-wrap">
            <div class="search-content">
                <?= $this->Form->create('category', ['url' => ['action' => 'search']])?>
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
            <?= $this->Form->create('myform', ['id' => 'batchdelform', 'url' => ['action' => 'batchdel']])?>
                <div class="result-title">
                    <div class="result-list">
                        <?= $this->Html->link('<i class="icon-font">&#xea0a;</i>'.__('Add Category', true), ['action' => 'add'], ['escape' => false]); ?>
                        <a id="batchDel" href="javascript:void(0)" onclick="formsubmit()"><i class="icon-font">&#xe9ac;</i>Batch Delete</a>
                        <a><input class="icon-font" name="batchdel" value="batchdel" type="submit" style="display:none"></a>
                        <?= $this->Html->link('<i class="icon-font">&#xea2e;</i>'.__('Refresh', true), ['action' => 'refresh'], ['escape' => false]); ?>
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
                                <td class="tc"><input name="id[]" value="<?= $category->id ?>" type="checkbox"></td>
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
          <?= $this->Form->end() ?>
    </div>
</div>
