<?php


use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\widgets\MaskedInput;
use app\modules\test_task\AppAsset;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\test_task\models\BooksSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Books';
$this->params['breadcrumbs'][] = $this->title;
AppAsset::register($this);
?>

<div class="books-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php $form = ActiveForm::begin([
        'action' => '',
        'method' => 'GET',
    ]); ?>

    <?= $form->field($searchModel, 'author_id', ['template' => '{input}{error}'])
        ->dropDownList($this->context->getAuthors(), [
            'prompt'=>'автор',
            'style' => 'width: 200px;',
        ]) ?>

    <?= $form->field($searchModel, 'name', ['template' => '{input}{error}'])
        ->textInput(['style' => 'width: 365px;', 'placeholder' => 'название книги']) ?>

    <br />

    <?= Html::label('Дата выхода книги:');?>
    <?= $form->field($searchModel, 'date_begin', ['template' => '{input}{error}'])->widget(MaskedInput::className(),[
        'mask' => 'y-m-d'
    ])->textInput(['style' => 'width: 200px;',]);
    ?>

    <?= Html::label('по');?>
    <?= $form->field($searchModel, 'date_end', ['template' => '{input}{error}'])->widget(MaskedInput::className(),[
        'mask' => 'y-m-d',
    ])->textInput(['style' => 'width: 200px;',]);
    ?>

    <div class="form-group pull-right">
        <?= Html::submitButton('Искать', ['class' => 'btn btn-primary']) ?>
        <?//= Html::a('Добавить книгу', ['create'], ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

    <?php
        yii\bootstrap\Modal::begin([
            'header' => '<span id="modalHeaderTitle"></span>',
            'id' => 'modal',
        ]);

        echo '<div id="modalContent"></div>';

        yii\bootstrap\Modal::end();
    ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'filterPosition'=>'',
        'columns' => [
            'id',
            'name',
            [
                'attribute' => 'preview',
                'format' => 'raw',
                'value' => function($data) {
                    return Html::a(Html::img(Url::to($data['preview']), ['class' => 'grid-img']),
                        Url::to($data['preview']), ['class' => 'preview-link']) ;
                }
            ],
            'author',
            [
                'attribute' => 'date',
                'format' => ['date', 'php: d F Y']
            ],
            [
                'attribute' => 'date_create',
                'value' => function($data) {
                    list($d, $t) = explode(' ', $data['date_create']);

                    if (empty($d)) return '';

                    return (new sfedosimov\daysago\DaysAgo())->make([$d, 'Y-m-d']);
                }
            ],

            [
                'class' => 'yii\grid\ActionColumn',
                'buttons'=>[
                    'view' => function ($url, $model, $key) {
                        $options = [
                            'data-toggle' => 'modal',
                            'data-target' => '#modal',
                            'value' => $url,
                            'class' => 'loadMainContent',
                            'style' => 'cursor: pointer;',
                            'title' => 'Просмотр',
                            'data-title' => $model->name
                        ];
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', FALSE, $options);
                    },
                ],
            ],
        ],
    ]); ?>

</div>
