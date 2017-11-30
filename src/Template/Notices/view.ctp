<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Notice $notice
 */
?>

<div class="container clearfix">
    
    <div class="main-wrap">

        <div class="crumb-wrap">
            <div class="crumb-list"><i class="icon-font"></i><a href="/erp/pages/home">Homgepage</a><span class="crumb-step">&gt;</span><a class="crumb-name" href="/erp/notices">Notices</a><span class="crumb-step">&gt;</span><span>View</span></div>
        </div>
        <?= $this->Flash->render() ?>
        <div class="result-wrap">
            <div class="result-content">
                <?= $this->Form->create('notice', ['type' => 'file']); ?>
                    <table class="insert-tab" width="100%">
                        <tbody><tr>
                            <th width="120"><i class="require-red">*</i>Categories</th>
                            <td>
                                <?= $this->Form->control('category', ['label' =>'', 'value' => $notice->category, 'options' => $category, 'empty' => true]);?>
                               
                            </td>
                        </tr>
                            <tr>
                                <th><i class="require-red">*</i>Title:</th>
                                <td>
                                    <?= $this->Form->text('title', ['value' => $notice->title, 'size' => '50',  'class' => 'common-text required']);?>
                                </td>
                            </tr>
                            <tr>
                                <th><i class="require-red"></i>Document:</th>
                                <td>
              
                                    <?= $this->Form->input('document', ['type' => 'file', 'label' => '', 'class' => 'form-control']); ?>
                                </td>
                            </tr>
                            <tr>
                                <th><i class="require-red"></i>Image:</th>
                                <td><?= $this->Form->input('image', ['type' => 'file', 'label' => '', 'class' => 'form-control']); ?></td>
                                
                            </tr>
                            <tr>
                                <th><i class="require-red"></i>Video:</th>
                                <td><input name="video" id="" type="file"></td>
                            </tr>
                            <tr>
                                <th>Content:</th>
                                
                                <td><?= $this->Form->textarea('content', ['value' => $notice->content, 'rows' => '10', 'style' => 'width:98%', 'cols' => '30']);?></td>
                            </tr>
                            <tr>
                                <th></th>
                                <td> 
                                   
                                    <?= $this->html->link('Back', ['action'=>'index'], ['class' => 'btn btn6', 'style' => 'width:100px']);?>
                                   
                                </td>
                            </tr>
                        </tbody></table>
                <?= $this->Form->end() ?>
            </div>
        </div>

    </div>
    <!--/main-->
</div>


<!--
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Notice'), ['action' => 'edit', $notice->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Notice'), ['action' => 'delete', $notice->id], ['confirm' => __('Are you sure you want to delete # {0}?', $notice->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Notices'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Notice'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="notices view large-9 medium-8 columns content">
    <h3><?= h($notice->title) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($notice->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Title') ?></th>
            <td><?= h($notice->title) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Text') ?></th>
            <td><?= h($notice->text) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Picture') ?></th>
            <td><?= h($notice->picture) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Video') ?></th>
            <td><?= h($notice->video) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Status') ?></th>
            <td><?= h($notice->status) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($notice->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Category') ?></th>
            <td><?= $this->Number->format($notice->category) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($notice->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($notice->modified) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Content') ?></h4>
        <?= $this->Text->autoParagraph(h($notice->content)); ?>
    </div>
</div>
-->