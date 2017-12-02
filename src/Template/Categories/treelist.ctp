<?php
echo $this->Form->control('categories', ['options' => $list]);
?>
<?php
foreach ($list as $categoryName) {
    echo $categoryName . "\n";
}
?>