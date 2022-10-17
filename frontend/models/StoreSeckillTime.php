<?php

namespace frontend\models;

use yii\db\ActiveRecord;
class StoreSeckillTime extends ActiveRecord
{
    //查询所有时间段
    public function getTime(){
        $model=new StoreSeckillTime;
        $res=$model->find()->asArray()->all();
        return $res;
    }
}