<?php

namespace frontend\models;

use yii\db\ActiveRecord;

class StoreSeckill extends ActiveRecord
{
    //查询分类商品
    public function typeGoods($cateId)
    {
        $model = new StoreSeckill;
        $res = $model->find()->all();
        return $res;
    }
}