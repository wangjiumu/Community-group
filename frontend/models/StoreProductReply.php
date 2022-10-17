<?php

namespace frontend\models;

use yii\db\ActiveRecord;
class StoreProductReply extends ActiveRecord
{
    //查询商品评论
    public function comment($productId){
        $model=new StoreProductReply;
        $res=$model->find()->where(['product_id'=>$productId])->asArray()->all();
        return $res;
    }
}