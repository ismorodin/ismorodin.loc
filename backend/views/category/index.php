<?php

use yii\bootstrap\Alert;
use yii\bootstrap\Carousel;
use yii\bootstrap\Collapse;
use yii\bootstrap\Modal;
use yii\bootstrap\Nav;

use yii\bootstrap\Tabs;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>
<div class="row">
   <?PHP
   foreach ($categories as $n => $category)
   {
       if ($category->level == $level) {
           echo Html::endTag('li') . "\n";
       } elseif ($category->level > $level) {
           echo Html::beginTag('ul') . "\n";
       } else {
           echo Html::endTag('li') . "\n";

           for ($i = $level - $category->level; $i; $i--) {
               echo Html::endTag('ul') . "\n";
               echo Html::endTag('li') . "\n";
           }
       }

       echo Html::beginTag('li');
       echo Html::encode($category->title);
       $level = $category->level;
   }

   for ($i = $level; $i; $i--) {
       echo Html::endTag('li') . "\n";
       echo Html::endTag('ul') . "\n";
   }
   ?>
</div>