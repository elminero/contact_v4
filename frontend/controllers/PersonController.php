<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Person;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PersonController implements the CRUD actions for Person model.
 */
class PersonController extends Controller
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
     * Displays a single Person model.
     * @return mixed
     */
    public function actionList()
    {
        if( Yii::$app->user->can('person-list') ) {

            $model = new Person();

            return $this->render('list', ['namesWithAddress'=>$model->getNamesWithAddress()] );

        }else {
            throw new ForbiddenHttpException;
        }

    }


    public function actionRemove($id)
    {
        if( Yii::$app->user->can('person-remove') ) {
            $model = new person();
            $model->setPersonLiveToZero($id);

            return $this->redirect(['person/list']);

        }else {
            throw new ForbiddenHttpException;
        }
    }

    /**
     * Displays a single Profile model.
     * @param int $id
     * @return mixed
     */
    public function actionProfile($id)
    {
        if( Yii::$app->user->can('person-profile') ) {

            $personModel = new Person();

            $avatar = $personModel->getAvatar($id);

            return $this->render('profile', ['model' => $this->findModel($id),  'avatar' => $avatar] );

        }else {
            throw new ForbiddenHttpException;
        }
    }



    /**
     * Displays a portfolio - picture galley.
     * @param int $id
     * @return mixed
     */
    public function actionPortfolio($id)
    {
        if( Yii::$app->user->can('person-portfolio') ) {

            return $this->render('portfolio', ['model' => $this->findModel($id), ]);

        }else {
            throw new ForbiddenHttpException;
        }

    }

    public function actionSelect($id)
    {
        if( Yii::$app->user->can('person-select') ) {

            if( isset($_GET['remove']) ) {
                $pictureId = (int)$_GET['remove'];
                $model = new Person();
                $model->setPictureLiveToZero($pictureId);
            }

            return $this->render('viewPicturesSelect', ['model' => $this->findModel($id), ]);

        }else {
            throw new ForbiddenHttpException;
        }
    }

    /**
     * Lists all Person models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Person::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Person model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Person model.
     * If creation is successful, the browser will be redirected to the 'profile' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if( Yii::$app->user->can('person-create') ) {

            $model = new Person();

            if ($model->load( Yii::$app->request->post()) && $model->save() ) {
                    return $this->redirect(['profile', 'id' => $model->id]);
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
     * Updates an existing Person model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['profile', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Person model.
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
     * Finds the Person model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Person the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Person::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
