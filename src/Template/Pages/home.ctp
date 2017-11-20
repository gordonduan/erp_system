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
  document.getElementById("batchdelform").submit();
}
</script>

<?php $this->set('toParent' , 'Categories');?>

<div class="main-wrap">

        <div class="crumb-wrap">
            <div class="crumb-list"><i class="icon-font">&#xe900;</i><a href="/erp/pages/home">Homepage</a></div>
        </div>
        <div class="search-wrap">
            <div class="search-content">
                        <table class="search-tab">
                        <tr>
                            <th width="70"></th>
                            <div style="margin-left:70px; font-size:24px">Welcome!......</div>

                        </tr>
                    </table>
            </div>
        </div>

        <div class="result-wrap" style="border-bottom: 0px">
            <?= $this->Form->create('myform', ['id' => 'batchdelform', 'url' => ['action' => 'batchdel']])?>
                <div class="result-title">

                </div>
                <div class="result-content">
                    <table class="result-tab" width="60%" style="margin-left:50px; margin-top:20px">
                        <tr>
                            <th scope="col"><?= $this->Paginator->sort('Author') ?></th>
                            <th scope="col"><?= $this->Paginator->sort('Description') ?></th>
                            <th scope="col"><?= $this->Paginator->sort('Created') ?></th>
                            <th scope="col"><?= $this->Paginator->sort('Modified') ?></th>
                        </tr>
                        <tbody>
                            <tr>
                                <td> <?= h('Gordon DUan') ?></td>
                                <td><?= h('ERP System Demo') ?></td>
                                <td><?= h('17/11/2017') ?></td>
                                <td><?= h('20/11/2017') ?></td>
                            </tr>
                        </tbody>
                    </table>

                </div>
          <?= $this->Form->end() ?>
    </div>
</div>
