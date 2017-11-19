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
            <div class="crumb-list"><i class="icon-font">&#xe900;</i><a href="#">Homepage</a><span class="crumb-step">&gt;</span><a class="crumb-name" href="/jscss/admin/design/">Categories</a><span class="crumb-step">&gt;</span><span>Add</span></div>
        </div>
        <div class="result-wrap" style="border-bottom: 0px">
            <div class="result-content">
              <?= $this->Form->create($category) ?>
                    <table class="insert-tab" width="100%">
                        <tbody>
                          <tr>
                            <th width="150">Parent Category：</th>
                            <td>
                              <?= $this->Form->control('parent_id', ['options' => $parentCategories, 'label' => '', 'empty' => true]);?>
                            </td>
                          </tr>
                          <tr>
                            <th><i class="require-red">*</i>Name：</th>
                              <td>
                                <?= $this->Form->text('name', ['size' => '50','class' => 'common-text required']);?>
                              </td>
                          </tr>
                          <tr>
                            <th>Description：</th>
                              <td>
                                <?= $this->Form->textarea('description', ['rows' => '10', 'style' => 'width:98%', 'cols' => '30']);?>
                              </td>
                          </tr>
                            <tr>
                                <th></th>
                                <td>
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
