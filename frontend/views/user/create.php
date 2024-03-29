<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var frontend\models\UsersModel $model */

$this->title = 'Create Users Model';
$this->params['breadcrumbs'][] = ['label' => 'Users Models', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="users-model-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
