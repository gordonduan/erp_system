<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Notice $notice
 */
?>


<div class="container clearfix">
    <!--/main-->
    <div class="main-wrap">
        <div class="crumb-wrap">
            <div class="crumb-list"><i class="icon-font">&#xe900;</i><a href="/erp/pages/home">Homgepage</a><span class="crumb-step">&gt;</span><a class="crumb-name" href="/erp/notices">Notices</a><span class="crumb-step">&gt;</span><span>Edit</span></div>
        </div>
        <?= $this->Flash->render() ?>
        <div class="result-wrap" style="border-bottom: 0px">
            <div class="result-content">
                <?= $this->Form->create('notice', ['type' => 'file']); ?>
                    <table class="insert-tab" width="100%">
                        <tbody>
                        <tr>
                            <th width="120"><i class="require-red">*</i>Categories</th>
                            <td colspan="3">
                                <?= $this->Form->control('category', ['label' =>'', 'value' => $notice->category, 'options' => $category, 'empty' => true]);?>
                            </td>
                        </tr>
                            <tr>
                                <th><i class="require-red">*</i>Title:</th>
                                <td colspan="3">
                                    <?= $this->Form->text('title', ['value' => $notice->title, 'size' => '50',  'class' => 'common-text required']);?>
                                </td>
                            </tr>
                            <tr>
                                <th><i class="require-red"></i>Document:</th>
                                <td style="border-right:none">
                                    <?php if (!empty($notice->document) & file_exists($_SERVER['DOCUMENT_ROOT'] . '/erp/webroot/'.$notice->document))echo $this->Html->link('<i class="icon-font">&#xe926;</i>'.__(trim(strrchr($notice->document, '/'),'/'), true), '/webroot/'.$notice->document, ['target' => '_blank', 'escape' => false]); ?>
                                </td>
                                <td style="border-left:none;border-right:none">
                                    <?php if (!empty($notice->document) & file_exists($_SERVER['DOCUMENT_ROOT'] . '/erp/webroot/'.$notice->document))echo $this->Html->link('<i class="icon-font">&#xea0b;</i>'.__('Delete', true), ['action' => 'deletefile',$notice->id,'document'], ['escape' => false]); ?>
                                </td>
                                <td style="border-left:none">
                                    <?= $this->Form->input('document', ['type' => 'file', 'label' => '', 'class' => 'form-control']); ?>
                                </td>
                            </tr>
                            <tr>
                                <th><i class="require-red"></i>Image:</th>
                                <td style="border-right:none">
                                    <?php if (!empty($notice->image) & file_exists($_SERVER['DOCUMENT_ROOT'] . '/erp/webroot/'.$notice->image)) echo $this->Html->link('<i class="icon-font">&#xe927;</i>'.__(trim(strrchr($notice->image, '/'),'/'), true), '/webroot/'.$notice->image, ['target' => '_blank','escape' => false]); ?>
                                </td>
                                <td style="border-left:none;border-right:none">
                                    <?php if (!empty($notice->image) & file_exists($_SERVER['DOCUMENT_ROOT'] . '/erp/webroot/'.$notice->image)) echo $this->Html->link('<i class="icon-font">&#xea0b;</i>'.__('Delete', true),['action' => 'deletefile',$notice->id,'image'], ['escape' => false]); ?>
                                </td>
                                <td style="border-left:none">
                                    <?= $this->Form->input('image', ['type' => 'file', 'label' => '', 'class' => 'form-control']); ?>
                                </td>
                            </tr>
                            <tr>
                                <th><i class="require-red"></i>Video:</th>
                                <td style="border-right:none">
                                    <?php if (!empty($notice->video) & file_exists($_SERVER['DOCUMENT_ROOT'] . '/erp/webroot/'.$notice->video)) echo $this->Html->link('<i class="icon-font">&#xe92a;</i>'.__(trim(strrchr($notice->video, '/'),'/'), true), '/webroot/'.$notice->video, ['target' => '_blank','escape' => false]); ?>
                                </td>
                                <td style="border-left:none;border-right:none">
                                    <?php if (!empty($notice->video) & file_exists($_SERVER['DOCUMENT_ROOT'] . '/erp/webroot/'.$notice->video)) echo $this->Html->link('<i class="icon-font">&#xea0b;</i>'.__('Delete', true),['action' => 'deletefile',$notice->id,'video'], ['escape' => false]); ?>
                                </td>
                                <td style="border-left:none">
                                    <?= $this->Form->input('video', ['type' => 'file', 'label' => '', 'class' => 'form-control']); ?>
                                </td>
                            </tr>
                            <tr>
                                <th>Content:</th>
                                <td colspan="3"><?= $this->Form->textarea('content', ['value' => $notice->content, 'rows' => '10', 'style' => 'width:98%', 'cols' => '30']);?></td>
                            </tr>
                            <tr>
                                <th></th>
                                <td colspan="3"> 
                                    <?= $this->Form->button(__('Submit'),['class' => 'btn btn-primary btn6 mr10']) ?>
                                    <?= $this->html->link('Back', ['action'=>'index'], ['class' => 'btn btn6', 'style' => 'width:100px']);?>
                                </td>
                            </tr>
                        </tbody>
                    </table>
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