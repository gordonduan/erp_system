<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Notice[]|\Cake\Collection\CollectionInterface $notices
 */
?>

<div class="main-wrap">
<!--/main-->
        <div class="crumb-wrap">
            <div class="crumb-list"><i class="icon-font">&#xe900;</i><a href="/erp/pages/home">Homepage</a><span class="crumb-step">&gt;</span><span class="crumb-name">Notices</span></div>
        </div>
        <?= $this->Flash->render() ?>
        <div class="search-wrap">
            <div class="search-content">
                <?= $this->Form->create('notices', ['url' => ['action' => 'search']])?>
                  <table class="search-tab">
                      <tr>
                          <th width="100">Categories:</th>
                          <td>
                              <select name="catid" id="catid" class="required">
                                    <option value="0">Please slect</option>
                                    <option value="1">Sales</option>
                                    <option value="2">Administration</option>
                                    <option value="3">HR</option>
                                    <option value="4">Finance</option>
                                    <option value="5">Business</option>
                              </select>
                          </td>
                          <th width="70">Title:</th>
                          <td><input class="common-text" placeholder="Title" name="keywords" value="" id="" type="text"></td>
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
                        <?= $this->Html->link('<i class="icon-font">&#xea0a;</i>'.__('Add Notice', true),['action' => 'add'], ['escape' => false]); ?>
                        <?= $this->Html->link('<i class="icon-font">&#xea2e;</i>'.__('Refresh', true), ['action' => 'refresh'], ['escape' => false]); ?>
                    </div>
                </div>
                <div class="result-content">
                    <table class="result-tab" width="100%">
                        <tr>
                                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('category') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('title') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('document') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('image') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('video') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                                <th scope="col" class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <tbody>
                            <?php foreach ($notices as $notice): ?>
                            <tr>
                                <td><?= $this->Number->format($notice->id) ?></td>
                                <td><?= h($notice->name) ?></td>
                                <td><?= h($notice->title) ?></td>
                                <td><?= h($notice->document) ?></td>
                                <td><?= h($notice->image) ?></td>
                                <td><?= h($notice->video) ?></td>
                                <td><?= h($notice->created) ?></td>
                                <td><?= h($notice->modified) ?></td>
                                <td class="actions">
                                    <?= $this->Html->link(__('View'), ['action' => 'view', $notice->id]) ?>
                                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $notice->id]) ?>
                                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $notice->id], ['confirm' => __('Are you sure you want to delete # {0}?', $notice->id)]) ?>
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
<!--/main-->
</div>

