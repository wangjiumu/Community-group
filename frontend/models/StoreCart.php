<?php

namespace frontend\models;

use yii\db\ActiveRecord;
class StoreCart extends ActiveRecord
{
    //秒杀商品加入购物车
    public function addCart($data,$userId,$num){
        var_dump($data);
        $model=new StoreCart();
        $model->uid=$userId;
        $model->type='秒杀';
        $model->product_id=$data['product_id'];
        $model->cart_num=$num;
        $model->add_time=time();
        $model->is_pay=0;
        $model->seckill_id=$data['id'];
        $res=$model->insert();
        var_dump($res);die();
        return $res;
    }
}