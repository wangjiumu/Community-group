<?php

namespace frontend\models;

use yii\db\ActiveRecord;

class StoreSeckill extends ActiveRecord
{
    //关联商品表
    public function getProduct()
    {
        return $this->hasOne(StoreProduct::class, ['id' => 'product_id']);
    }

    //关联秒杀时段表
    public function getTime()
    {
        return $this->hasOne(StoreSeckillTime::class, ['time_id' => 'time_id']);
    }

    //查询秒杀商品
    public function typeGoods($timeId)
    {
        $model = new StoreSeckill;
        $res = $model->find()
            ->with('product', 'time')
            ->where(['is_show' => 1])//上架商品
            ->where(['time_id' => $timeId])
            ->orderBy(['add_time' => SORT_DESC])//时间倒序排列
            ->asArray()//关联查询转数组
            ->all();
        $data = [];
        foreach ($res as $val) {
            //抢购商品百分比
            $val['percent'] = 20 / $val['stock'];
            $data[] = $val;
        }
        return $data;
    }

    //秒杀商品详情
    public function seckillDetail($id)
    {
        $model = new StoreSeckill;
        $res = $model->find()
            ->with('product')
            ->where(['id' => $id])
            ->asArray()
            ->one();
        return $res;
    }

}