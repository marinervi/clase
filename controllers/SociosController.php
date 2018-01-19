<?php

namespace app\controllers;

use Yii;
use app\models\Socios;
use app\models\Clientes;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * SociosController implements the CRUD actions for Socios model.
 */
class SociosController extends Controller {

    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Socios models.
     * @return mixed
     */
    public function actionIndex($id = 0) {

        $modelo = Socios::findOne(["id" => $id]);
        $dataProvider = new ActiveDataProvider([
            'query' => Socios::find(),
        ]);

        return $this->render('index', [
                    'dataProvider' => $dataProvider,
                    'modelo' => $modelo,
        ]);
    }

    public function actionIndex1($id) {
        
        // metodo normal
        //$modelo = Clientes::find()->where(["socio" => $id]);
        //var_dump($modelo);
        
        /* no es muy aconsejable */
        /* para listados como array y no como modelos */
        //$modelo = Yii::$app->db->createCommand('select * from clientes where socio=$id');
        //var_dump($modelo);
        
        /* Para consultas complejas de seleccion */
        $modelo= (new \yii\db\Query())->from('clientes')->where(["socio" => $id]);
        //var_dump($modelo);
        
        //le mando el activeQuery al dataProvider
        $dataProvider = new ActiveDataProvider([
            'query' => $modelo,
        ]);

        return $this->render('clientes', [
                    'dataProvider' => $dataProvider,
        ]);
    }
    
    
        public function actionIndex2($id) {
        
        // metodo normal
        $modelo = Clientes::find()->where(["clientes.socio" => $id])->with('socio0');
        
        //socio0 es el nombre de la relacion que ha dado gii a la relacion con cliente
        //en el modelo Clientes
        
        /*ahora con JQuery*/   
           
        //$m=Socios::find()->with('clientes')->all();
        
        /*$m=(new \yii\db\Query())->select("clientes.id as idc")->from("clientes")->join("LEFT JOIN","socios","clientes.socio=socios.id")->where(["socios.id" => $id])->all();
        echo "<pre>";
        \yii\helpers\VarDumper::dump($m);
        echo "</pre>";
        */
      
        $dataProvider = new ActiveDataProvider([
            'query' => $modelo,
        ]);

        return $this->render('clientesSocios', [
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Socios model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Socios model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Socios();

        if ($model->load(Yii::$app->request->post())) {
            $model->foto = UploadedFile::getInstance($model, 'foto');
            if ($model->upload()) {
                $model->save();
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('create', [
                    'model' => $model,
        ]);
    }

    /**
     * Updates an existing Socios model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $model->foto = UploadedFile::getInstance($model, 'foto');
            if ($model->upload()) {
                $model->save();
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }


        return $this->render('update', [
                    'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Socios model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Socios model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Socios the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Socios::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}
