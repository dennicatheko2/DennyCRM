<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Ticket */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ticket-form">

    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'category')->dropDownList(['Sales'=>'Sales','Accounting'=>'Accounting','IT'=>'IT']) ?>

    <?= $form->field($model, 'status')->dropDownList(['Assigned'=>'Assigned','In progress'=>'In progress','Resolved'=>'Resolved']       ) ?>

    <?= $form->field($model, 'date_created')?>

    <?= $form->field($model, 'comments')->textarea(['rows'=>6]) ?>

    <?= $form->field($model, 'location')->textInput(['maxlength' => true]) ?>

    

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
