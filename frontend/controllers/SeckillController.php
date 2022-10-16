<?php

namespace frontend\controllers;

use frontend\models\StoreSeckill;
use yii\web\Controller;

class SeckillController extends Controller
{
    //分组查询商品
    public function actionIndex()
    {
        $request = \Yii::$app->request;
        //接收商品分类id
        $cateId = $request->get('cate_id');
        $result = (new StoreSeckill())->typeGoods($cateId);
        return json_encode($result);
    }
}