<?php

namespace app\models;

use app\components\dto\PlotDto;
use Yii;

/**
 * This is the model class for table "cadastre".
 *
 * @property int $id
 * @property string|null $number
 * @property string|null $address
 * @property float|null $price
 * @property int|null $area
 * @property string|null $links_json
 * @property string|null $last_api_updated_at
 * @property string|null $last_api_response_json
 * @property string|null $last_api_check_at
 * @property string|null $created_at
 * @property string|null $updated_at
 */
class Cadastre extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cadastre';
    }

    public function fillFromPlotDto(PlotDto $dto)
    {
        $this->number = $dto->attrs['plot_number'];
        $this->address = $dto->attrs['plot_address'];
        $this->price = $dto->attrs['plot_price'];
        $this->area = $dto->attrs['plot_area'];
    }

    public function timestampApiCheck()
    {
        $this->last_api_check_at = date('Y-m-d H:i:s');
    }

    public function timestampCreatedAt()
    {
        $this->created_at = date('Y-m-d H:i:s');
    }

    public function timestampUpdatedAt()
    {
        $this->updated_at = date('Y-m-d H:i:s');
    }
}
