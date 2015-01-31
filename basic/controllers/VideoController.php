<?php

namespace app\Controllers;

use Yii;
use app\models\Video;
use app\models\Category;
use app\models\SubCategory;
use app\models\VideoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use UploaderHandler;

/**
 * VideoController implements the CRUD actions for Video model.
 */
class VideoController extends Controller
{

    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Video models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new VideoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Video model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($md5)
    {
        return $this->render('view', [
            'model' => Video::findOne(['md5'=>$md5]),
        ]);
    }

    /**
     * Creates a new Video model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Video();
        $selectArray = array();
        $fcates = Category::find()->where('id>0')->all();
        array_push($selectArray,ArrayHelper::map($fcates,'id','name'));
        foreach ($fcates as $fcate) {
            $sons = SubCategory::findAll(['father_id'=>$fcate->id]);
            array_push($selectArray,ArrayHelper::map($sons,'id','name'));
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'category' => $selectArray,
            ]);
        }
    }

    /**
     * Updates an existing Video model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Video model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Video model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Video the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Video::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionUploader()
    {
        $upload_handler = new \UploadHandler();
        $video_objects = $upload_handler->get_video_objects();
        foreach($video_objects as $video)
        {
            $one = new video();
            $one->attributes = $video;
            if($one->save())
                ;
            else
                echo json_encode($one->getErrors());

        }
    }

    public function actionTest()
    {

        $selectArray = array();
        $fcates = Category::find()->where('id>0')->all();
        array_push($selectArray,ArrayHelper::map($fcates,'id','name'));
        foreach ($fcates as $fcate) {
            $sons = SubCategory::findAll(['father_id'=>$fcate->id]);
            array_push($selectArray,ArrayHelper::map($sons,'id','name'));
        }
        echo json_encode($selectArray);
    }

    public function actionSetcategory($md5)
    {
        $Video = Video::find()->where(['md5'=>$md5])->one();
        $Video->setAttributes(Yii::$app->request->post());
        echo json_encode($Video->getAttributes());
        if ($Video->save()) {
            echo "{'status:0'}";
        }
        else echo json_encode($Video->getErrors());
    }



}
