<?php
/** @var $result string */

use yii\helpers\Html;

?>
<a href="/">< Back</a>
<h3>Console app demo</h3>

<form>
    <input name="cadastreNumbers" value="<?=Html::encode($_GET['cadastreNumbers'] ?? null) ?>">
    <input type="submit" value="Go">
</form>

<pre><?= $result ?></pre>