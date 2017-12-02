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
                                    <?= $this->Form->button(__('Submit'),['class' => 'btn btn-primary btn6 mr10']) ?>
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
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $notice->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $notice->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Notices'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="notices form large-9 medium-8 columns content">
    <?= $this->Form->create($notice) ?>
    <fieldset>
        <legend><?= __('Edit Notice') ?></legend>
        <?php
            echo $this->Form->control('category');
            echo $this->Form->control('name');
            echo $this->Form->control('title');
            echo $this->Form->control('text');
            echo $this->Form->control('picture');
            echo $this->Form->control('video');
            echo $this->Form->control('content');
            echo $this->Form->control('status');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
-->