<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Product $product
 */
?>

<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Category $category
 */
?>

<script>
function getdata(id)
{
    var xmlhttp;
    if (id=="")
    {
        document.getElementById("txtHint").innerHTML="";
        return;
    } 
    else{
        document.getElementById("txtHint").innerHTML=id;
    }
    
    
     var request = new XMLHttpRequest();
  
    request.onreadystatechange = function() {
        if (request.readyState === 4) {
            alert(request.status);
            alert(request.responseText);
            document.getElementById("txtHint").innerHTML=request.responseText;
            if (request.status === 200) {
                       // OK

                       alert('ok!');
            } else {
                       // not OK
                       alert('failure!');
            }
        }
    };

    request.open('POST', '/erp/details/product', true);
    request.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    request.send("id="+id);
    
}
</script>


<div class="container clearfix">

    <!--/sidebar-->
    <div class="main-wrap">

        <div class="crumb-wrap">
            <div class="crumb-list"><i class="icon-font">&#xe900;</i><a href="/erp/pages/home">Homepage</a><span class="crumb-step">&gt;</span><a class="crumb-name" href="/erp/orders">Orders</a><span class="crumb-step">&gt;</span><span>Add</span></div>
        </div>
        <div class="result-wrap" style="border-bottom: 0px">
            <div class="result-content">
              <?= $this->Form->create('order') ?>
                    <table class="insert-tab" width="100%">
                        <tbody>
                          <tr>
                            <th width="150"><i class="require-red">*</i>Product：</th>
                            <td>
                                <?= $this->Form->control('product_id', ['label' =>'', 'onchange' => 'getdata(this.value)', 'options' => $products, 'empty' => true]);?>
                             <div id="txtHint"><b>web info……</b></div>
                             <div id="response-content"><b>testing……</b></div>
                            </td>
                          </tr>
                          <tr>
                            <th><i class="require-red">*</i>Name：</th>
                              <td>
                                <?= $this->Form->text('name', ['value' => $order->name, 'size' => '50',  'class' => 'common-text required']);?>
                              </td>
                          </tr>

                          <tr>
                            <th>Description：</th>
                              <td>
                                <?= $this->Form->textarea('description', ['rows' => '10', 'style' => 'width:98%', 'cols' => '30']);?>
                              </td>
                          </tr>
                          <tr>
                            <th>Quantity：</th>
                              <td>
                                <?= $this->Form->control('quantity',['label' =>'',])?>
                              </td>
                          </tr>

                          <tr>
                            <th><i class="require-red">*</i>Order Type：</th>
                              <td>
                                <select name="type">
                                  <option value="">(choose one)</option>
                                  <option value="0">Purchasing Order</option>
                                  <option value="1">Sales Order</option>
                              </td>
                          </tr>
                          <tr>
                              <input type="hidden" name="status" value="0" />
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






















<!--
<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Order $order
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Orders'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Products'), ['controller' => 'Products', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Product'), ['controller' => 'Products', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="orders form large-9 medium-8 columns content">
    <?= $this->Form->create($order) ?>
    <fieldset>
        <legend><?= __('Add Order') ?></legend>
        <?php
            echo $this->Form->control('product_id', ['options' => $products, 'empty' => true]);
            echo $this->Form->control('name');
            echo $this->Form->control('description');
            echo $this->Form->control('quantity');
            echo $this->Form->control('type');
            echo $this->Form->control('status');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
-->
