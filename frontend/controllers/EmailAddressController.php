<?php

namespace frontend\controllers;

use Yii;
use frontend\models\EmailAddress;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * EmailAddressController implements the CRUD actions for EmailAddress model.
 */
class EmailAddressController extends Controller
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
     * Lists all EmailAddress models.
     * @return mixed
     */
    public function actionIndex()
    {
        if( Yii::$app->user->can('email-address-index') ) {

            $dataProvider = new ActiveDataProvider([
                'query' => EmailAddress::find(),
            ]);

            return $this->render('index', [
                'dataProvider' => $dataProvider,
            ]);

        }else {
            throw new ForbiddenHttpException;
        }
    }

    /**
     * Displays a single EmailAddress model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if( Yii::$app->user->can('email-address-view') ) {

            return $this->render('view', [
                'model' => $this->findModel($id),
            ]);

        }else {
            throw new ForbiddenHttpException;
        }

    }

    /**
     * Creates a new EmailAddress model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if( Yii::$app->user->can('email-address-create') ) {

            $model = new EmailAddress();

            if( isset($_GET['id']) ) {
                $model->person_id = (int)$_GET['id'];
            }

            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['person/profile', 'id' => $model->person_id]);
            } else {
                return $this->render('create', [
                    'model' => $model,
                ]);
            }

        }else {
            throw new ForbiddenHttpException;
        }
    }

    /**
     * Updates an existing EmailAddress model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        if( Yii::$app->user->can('email-address-update') ) {
            $model = $this->findModel($id);

            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['person/profile', 'id' => $model->person_id]);
            } else {
                return $this->render('update', [
                    'model' => $model,
                ]);
            }
        }else {
            throw new ForbiddenHttpException;
        }
    }

    /**
     * Deletes an existing EmailAddress model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        if( Yii::$app->user->can('email-address-delete') ) {

            $this->findModel($id)->delete();

            return $this->redirect(['index']);

        }else {
            throw new ForbiddenHttpException;
        }
    }


    public function actionRemove($id)
    {
        $model = new EmailAddress();
        $model->setEmailAddressLiveToZero($id);

        return $this->redirect(['person/profile', 'id' => $model->getPersonIdByEmailAddressId($id)]);
    }



    /**
     * Finds the EmailAddress model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return EmailAddress the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = EmailAddress::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
