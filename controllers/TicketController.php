<?php

namespace app\controllers;

use yii;
use app\models\Ticket;
use app\models\TicketSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\base\Model;
use app\models\Webuser;
use DateTime;
use MongoDB\BSON\Javascript;


/**
 * TicketController implements the CRUD actions for Ticket model.
 */
class TicketController extends Controller
{
    /**
     * @inheritDoc
     */
    
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'access' =>[
                    'class'=>AccessControl::className(),
                    'only'=>['create','update'], //access control here
                    'rules'=>[
                        [
                        'allow'=>true,
                        'roles'=>['@']
                            ],
                    ]
                        ],

                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Ticket models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new TicketSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Ticket model.
     * @param int $ticketId Ticket ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($ticketId)
    {
        return $this->render('view', [
            'model' => $this->findModel($ticketId),
        ]);
    }

    /**
     * Creates a new Ticket model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Ticket();

        $model->date_created=date('Y-m-d');
        $model->userId= Yii::$app->user->identity->id;
        $model->location ="Latitude: -26.202968643640205
        Longitude: 28.04068052757975";
        
        

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {

            

                return $this->redirect(['view', 'ticketId' => $model->ticketId]);
            }
        } else {
            
            
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Ticket model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $ticketId Ticket ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($ticketId)
    {
        $model = $this->findModel($ticketId);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'ticketId' => $model->ticketId]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Ticket model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $ticketId Ticket ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($ticketId)
    {
        $this->findModel($ticketId)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Ticket model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $ticketId Ticket ID
     * @return Ticket the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($ticketId)
    {
        if (($model = Ticket::findOne(['ticketId' => $ticketId])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
