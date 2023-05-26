<?php


namespace app\components;


use yii\grid\Column;
use yii\grid\DataColumn;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\BaseListView;

class GridViewSimple extends GridView
{
    public function run()
    {
        //bypass js
        BaseListView::run();
    }

    public function renderFilters()
    {
        if ($this->filterModel !== null) {
            $cells = [];
            foreach ($this->columns as $column) {
                /* @var $column Column */
                if(isset($column->attribute)) {
                    if ($column instanceof DataColumn && is_array($column->filter)) {
                        $filterContent = Html::dropDownList($column->attribute, \Yii::$app->request->get($column->attribute), $column->filter, ['prompt' => '']);
                    }
                    else {
                        $filterContent = '<input name=' . $column->attribute . ' value="' . \Yii::$app->request->get($column->attribute) . '">';
                    }
                }
                else {
                    $filterContent = '';
                }
                $cells[] = '<td>'.$filterContent.'</td>';
            }

            $formControlButtonsHtml = '<input class="btn btn-light" type="submit">&nbsp;<a class="btn btn-light" href="/' . \Yii::$app->request->getPathInfo() . '">Reset</a>';
            if($cells[array_key_last($cells)]) {
                $cells[array_key_last($cells)] = strtr($cells[array_key_last($cells)], ['</td>' => '&nbsp;'.$formControlButtonsHtml.'</td>']);
            }
            else {
                $cells[array_key_last($cells)] = '<td>'.$formControlButtonsHtml.'</td>';
            }
            $trContent = implode('', $cells);
            $trContent = '<form method="get">'.$trContent.'</form>';

            return Html::tag('tr', $trContent, $this->filterRowOptions);
        }

        return '';
    }


}