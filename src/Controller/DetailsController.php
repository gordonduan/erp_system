<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Orders Controller
 *
 * @property \App\Model\Table\OrdersTable $Orders
 *
 * @method \App\Model\Entity\Order[] paginate($object = null, array $settings = [])
 */
class DetailsController extends AppController
{
    public $paginate = [
      'contain' => ['Products'],
      'limit' => 8
    ];
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    
    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('RequestHandler');
        $this->loadModel('Products');
        $this->loadModel('Orders');
    }

    public function returndetails(){

        $id = $this->params['named']['id'];
        $data = $this->Details->Products->findById($id);
//        $this->log($data);
        pr('Some text to test if the request is working'); 
    }
    
    
    public function product(){
//        $this->log($this->request->data);
        $controllerName = $this->request->getParam('controller');
        $passedArgs = $this->request->getParam('pass');
//        $this->log($controllerName);
//        $this->log($passedArgs);
        
//        $this->log($this->request->getdata('id'));
        $id=$this->request->getdata();        
//        $this->log($id);
//        if ($this->request->is('ajax')) {
//        $this->response->disableCache();
//        }
        
        
        if ($this->request->is('post'))
        {
          if(!empty($this->request->data) && isset($this->request->data) )
          {
             $data = $this->Products->findById($id);
//             $this->log($data);
           //   $querys = $this->paginate($resultsArray);
             $this->set('product',$data);
             $this->render('index');
          }
        }
//        $products = $this->Orders->Products->find('list', ['limit' => 200]);
//        $this->set(compact('order', 'products'));
//        $this->set('_serialize', ['order']);
    }
    
        public function add()
        {
//            $this->log($this->request->getData());
            $order = $this->Orders->newEntity();
            if ($this->request->is('post')) {
                $order = $this->Orders->patchEntity($order, $this->request->getData());
                if ($this->Orders->save($order)) {
                    $this->Flash->success(__('The order has been saved.'));

                    return $this->redirect(['action' => 'index']);
                }
                $this->Flash->error(__('The order could not be saved. Please, try again.'));
            }
            $products = $this->Orders->Products->find('list', ['limit' => 200]);
            $this->set(compact('order', 'products'));
            $this->set('_serialize', ['order']);
        }
    
    public function triggerConnect()
    {
        $this->autoRender = false;
        $id = $this->request->getData('server_id');

        $server = $this->UserServers->get($id);
        $ftp = new \FtpClient\FtpClient();
        $ftp->connect($server->server_url);

        $res = $ftp->login($server->server_username, $server->server_password);

        if ($res) {
            $response['code'] = 100;
            $response['type'] = 'Success';
            $response['message'] = 'Login Success';
            $response['content'] = $ftp->scanDir();
        } else {
            $response['code'] = 101;
            $response['type'] = 'Error';
            $response['message'] = 'Login Failed';
        }

        echo json_encode($response);
    }
        
        
//    
//    public function return() 
//    {
//        $this->log($this->request->getdata());
//        $this->log($this->request->data);  
        
//    if($this->request->is('ajax')) { //判断是否为Ajax请求
//        $userId = $this->request->getData('userId'); //获取请求参数
//        $this->log('$userId');
//        $this->response = $this->response->withType('application/json') //设置响应类型
//            ->withStringBody(json_encode(['userId' => $userId])); //设置响应数据
//    }
//    return $this->response; //返回Cake\Http\Response对象
//}
          
}
