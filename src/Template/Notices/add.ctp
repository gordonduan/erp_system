<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Notice $notice
 */
?>
<script>
$(document).ready(function(){
$("#catid").change(function(){  
        //code...  
        var category_text=$("#catid").find("option:selected").text();  
        $("#noticecat").val(category_text);  
    })
});  
</script>  

<div class="container clearfix">
    
    <div class="main-wrap">

        <div class="crumb-wrap">
            <div class="crumb-list"><i class="icon-font"></i><a href="/erp/pages/home">Homgepage</a><span class="crumb-step">&gt;</span><a class="crumb-name" href="/erp/notices">Notices</a><span class="crumb-step">&gt;</span><span>Add</span></div>
        </div>
        <?= $this->Flash->render() ?>
        <div class="result-wrap">
            <div class="result-content">
                <?= $this->Form->create('notice', ['type' => 'file']); ?>
                    <table class="insert-tab" width="100%">
                        <tbody><tr>
                            <th width="120"><i class="require-red">*</i>Categories</th>
                            <td>
                                <select name="catid" id="catid" class="required">
                                    <option value="0">Please slect</option>
                                    <option value="1">Sales</option>
                                    <option value="2">Administration</option>
                                    <option value="3">HR</option>
                                    <option value="4">Finance</option>
                                    <option value="5">Business</option>
                              </select>
                                <input type = "hidden" class="common-text required" id="noticecat" name="noticecat" size="50" value="" type="text">
                            </td>
                        </tr>
                            <tr>
                                <th><i class="require-red">*</i>Title:</th>
                                <td>
                                    <input class="common-text required" id="title" name="title" size="50" value="" type="text">
                                </td>
                            </tr>
                            <tr>
                                <th><i class="require-red"></i>Document:</th>
                                <td>
                           <!--        <?= $this->Form->create('document', ['type' => 'file']);?> <?= $this->Form->file('submittedfile');?> -->
                           <!--         <input name="document" id="" type="file"> -->
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
                                <td><textarea name="content" class="common-textarea" id="content" cols="30" style="width: 98%;" rows="10"></textarea></td>
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

-->

<!--
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Notices'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="notices form large-9 medium-8 columns content">
    <?= $this->Form->create($notice) ?>
    <fieldset>
        <legend><?= __('Add Notice') ?></legend>
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