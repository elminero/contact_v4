<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Picture;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PictureController implements the CRUD actions for Picture model.
 */
class PictureController extends Controller
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
     * Lists all Picture models.
     * @return mixed
     */
    public function actionIndex()
    {
        if( Yii::$app->user->can('picture-index') ) {

            $dataProvider = new ActiveDataProvider([
                'query' => Picture::find(),
            ]);

            return $this->render('index', [
                'dataProvider' => $dataProvider,
            ]);
        }else {
            throw new ForbiddenHttpException;
        }
    }

    /**
     * Displays a single Picture model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if( Yii::$app->user->can('picture-view') ) {
            return $this->render('view', [
                'model' => $this->findModel($id),
            ]);
        }else {
            throw new ForbiddenHttpException;
        }
    }

    /**
     * Creates a new Picture model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if( Yii::$app->user->can('picture-create') ) {
            $model = new Picture();

            if( isset($_GET['id']) ) {
                $model->person_id = (int)$_GET['id'];
            }

            if ($model->load(Yii::$app->request->post()) ) {

                $path = $model->createImageFolder();

                $randHex = substr(md5(rand()), 0, 8);

                $model->file_name = $path . $randHex;

                $file = \yii\web\UploadedFile::getInstance($model, 'file_name');

                $pathToImageFileFullSize = 'pictures/' . $model->file_name . ".jpg";

                $pathToImageFileSmallSize = 'pictures/' . $model->file_name . "_t.jpg";

                $file->saveAs($pathToImageFileFullSize);

                copy($pathToImageFileFullSize, $pathToImageFileSmallSize);

                $model->reduceToFullSize($pathToImageFileFullSize);

                $model->reduceToSmallSize($pathToImageFileSmallSize);


                /*
                 * if avatar was selected, remove any avatar previously selected
                 */
                if($model->avatar == 1) {
                    $model->setAvatarToZeroByPersonId($model->person_id);
                    $model->save();
                    return $this->redirect(['person/profile', 'id' => $model->person_id]);
                } else {
                    $model->save();
                    return $this->redirect(['person/portfolio', 'id' => $model->person_id]);
                }

            } else {
                return $this->render('create', ['model' => $model,]);
            }

        }else {
            throw new ForbiddenHttpException;
        }

    }

    /**
     * Updates an existing Picture model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        if( Yii::$app->user->can('picture-update') ) {

            $model = $this->findModel($id);

            if ($model->load(Yii::$app->request->post())) {

                if ($model->avatar) {
                    $model->setAvatarToZeroByPersonId($model->person_id);
                }

                $model->save();

                if ($model->avatar) {
                    return $this->redirect(['person/profile', 'id' => $model->person_id]);
                }

                return $this->redirect(['person/select', 'id' => $model->person_id]);
            } else {

                return $this->render('update', ['model' => $model,]);
            }
        }else {
            throw new ForbiddenHttpException;
        }

    }

    /**
     * Deletes an existing Picture model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        if( Yii::$app->user->can('picture-delete') ) {
            $this->findModel($id)->delete();

            return $this->redirect(['index']);

        }else {
            throw new ForbiddenHttpException;
        }
    }

    public function actionRemove($id)
    {
        if( Yii::$app->user->can('picture-remove') ) {

            $model = new Picture();
            $model->setPictureLiveToZero($id);

            return $this->redirect(['person/select', 'id' => $model->getPersonIdByPictureId($id)]);
        }else {
            throw new ForbiddenHttpException;
        }
    }


    public function actionDisplay($id)
    {
        if( Yii::$app->user->can('picture-display') ) {

            $model = new Picture();

            return $this->render('display', ['model' => $this->findModel($id),
                'previous' => $model->getPreviousPicture($id),
                'next' => $model->getNextPicture($id) ]);
        }else {
            throw new ForbiddenHttpException;
        }

    }

    /**
     * Finds the Picture model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Picture the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Picture::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
