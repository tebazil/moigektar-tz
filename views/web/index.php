<?php

use yii\helpers\Html;

?>
    <style>
        td, th {
            border-style: solid;
            border-width: 1px;
            border-color: black;
        }
    </style>

<a href="/">Back</a>
<h3>Web app demo</h3>

<form>
    <input name="cadastreNumbers" value="<?=Html::encode($_GET['cadastreNumbers'] ?? null) ?>">
    <input type="submit" value="Go">
</form>

<?php
/** @var $this \yii\web\View */
/** @var $dp \yii\data\ArrayDataProvider */

(new \app\components\GridViewSimple([
    'dataProvider' => $dp,
]))->run();
