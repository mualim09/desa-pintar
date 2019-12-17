<?php
/**
 * Created by PhpStorm.
 * User: ELL
 * Date: 20/12/2017
 * Time: 15.37
 */

namespace backend\controllers\mitra;


use backend\controllers\BaseController;
use Yii;
use yii\base\Exception;
use yii\helpers\Url;
use backend\models\Pembangunan;
use kartik\mpdf;

class ReportController extends BaseController
{
    public function actions()
    {
        return parent::actions(); // TODO: Change the autogenerated stub
    }
    public function behaviors()
    {
        return parent::behaviors(); // TODO: Change the autogenerated stub
    }
    public function actionIndex(){
        if (!parent::isLogin()) {
            return $this->redirect(Url::toRoute('site/login'));
        }
        $sesi = $this->activeUser;
        $pembangunanOption=[];
        $pembangunan=Pembangunan::find()
            ->innerJoinWith('mitra')
            ->where(['{{mitra}}.[[users_id]]'=>$sesi->id])
            ->all();
        foreach ($pembangunan as $item){
            $pembangunanOption[$item->id]=$item->nama_pembangunan;
        }

        $params=[
            'pembangunanOption'=>$pembangunanOption,
        ];

        return $this->render('index.tpl',$params);
    }

}