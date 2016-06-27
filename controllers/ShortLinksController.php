<?php

namespace mitrm\links\controllers;

use Yii;
use mitrm\links\models\ShortLinks;
use mitrm\links\models\search\ShortLinksSearch;
use yii\web\Controller;
use yii\validators\EmailValidator;
use yii\validators\UrlValidator;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;

/**
 * ShortLinksController implements the CRUD actions for ShortLinks model.
 */
class ShortLinksController extends Controller
{

    /**
     * Редирект с короткой ссылке
     * @param $token
     * @throws NotFoundHttpException
     */
    public function actionRedirect($token)
    {
        $link = ShortLinks::findByToken($token);
        if($link) {

            return $this->redirect($link);
        }
        throw new NotFoundHttpException('Не найдена короткая ссылка');
    }

    /**
     * Создание короткой ссылки
     * @return array
     */
    public function actionNew()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $error = $short_link = false;
        $link = Yii::$app->request->post('link');
        $title = Yii::$app->request->post('title');

        $validator = new UrlValidator();

        if (!$validator->validate($link, $error)) {
            $error = 'Укажите верную ссылку, пример http://site.ru/link';
        } else {
            $short_link = 'http://'.$this->module->domain.'/l/'.ShortLinks::saveLink($link, $title);

        }

        return ['short_link' => $short_link, 'status' => $short_link ? true : false, 'error' => $error];
    }

    /**
     * Lists all ShortLinks models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ShortLinksSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ShortLinks model.
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
     * Creates a new ShortLinks model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ShortLinks();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['update', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing ShortLinks model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['update', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing ShortLinks model.
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
     * Finds the ShortLinks model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ShortLinks the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ShortLinks::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
