<?php

namespace frontend\controllers;

use common\server\Common;
use frontend\models\StoreCart;
use frontend\models\StoreProductReply;
use frontend\models\StoreSeckill;
use frontend\models\StoreSeckillTime;
use yii\web\Controller;

class SeckillController extends Controller
{
    //时间展示
    public function actionTime(){
        $request = \Yii::$app->request;
        $request->get();
        $timeData=(new StoreSeckillTime())->getTime();
        return json_encode(['data'=>$timeData,'code'=>200,'msg'=>'时间查询成功']);
    }

    //查询秒杀商品
    public function actionIndex()
    {
        $request = \Yii::$app->request;
        //接收时间分类id
        $timeId = $request->get('time_id');
        if (empty($timeId)){
            //查询秒杀商品
            $result = (new StoreSeckill())->typeGoods(1);
        }else{
            //查询秒杀商品
            $result = (new StoreSeckill())->typeGoods($timeId);
        }
        return json_encode(['data'=>$result,'code'=>200,'msg'=>'查询成功']);
    }

    //秒杀商品详情
    public function actionDetail(){
        $request = \Yii::$app->request;
        //接收秒杀商品id
        $productId = $request->post('product_id');
        //当前时间
        $nowTime=time();
        //查询秒杀商品详情
        $seckillData=(new StoreSeckill())->seckillDetail($productId);
        //秒杀开始时间
        $startTime=$seckillData['start_time'];
        //秒杀结束时间
        $stopTime=$seckillData['stop_time'];
        if($nowTime<$startTime){
            return json_encode(['data'=>[],'code'=>1010,'msg'=>'秒杀时间未开始']);
        }
        if($nowTime>$stopTime){
            return json_encode(['data'=>[],'code'=>1011,'msg'=>'秒杀时间已结束']);
        }
        //秒杀倒计时
        $seckillData['countdown']=$stopTime-$nowTime;
        return json_encode(['data'=>[$seckillData],'code'=>200,'msg'=>'详情查询成功']);
    }

    //秒杀商品评论
    public function actionComment(){
        $request = \Yii::$app->request;
        //接收秒杀商品id
        $productId = $request->post('product_id');
        //查询商品评论
        $commentData=(new StoreProductReply())->comment($productId);
        return json_encode(['data'=>[$commentData],'code'=>200,'msg'=>'评论查询成功']);
    }

    //支付页面
    public function actionPay(){
        $request = \Yii::$app->request;
        //接收秒杀商品id
        $productId = $request->post('product_id');
        $seckillData=(new StoreSeckill())->seckillDetail($productId);
        return json_encode(['data'=>[$seckillData],'code'=>200,'msg'=>'支付商品详情查询成功']);
    }

    //秒杀商品加入购物车
    public function actionCart(){
        $request = \Yii::$app->request;
        //接收秒杀商品id
        $productId = $request->post('product_id');
        //用户id
        $userId = $request->post('uid');
        //商品数量
        $num = $request->post('num');
        //秒杀商品详情
        $seckillData=(new StoreSeckill())->seckillDetail($productId);
        //添加到购物车
        $result=(new StoreCart())->addCart($seckillData,$userId,$num);
        if ($result){
            return json_encode(['data'=>[],'code'=>200,'msg'=>'添加购物车成功']);
        }
        return json_encode(['data'=>[],'code'=>1012,'msg'=>'添加购物车失败']);

    }
}