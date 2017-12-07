<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Datasource\ConnectionManager;
/**
 * Orders Controller
 *
 * @property \App\Model\Table\OrdersTable $Orders
 *
 * @method \App\Model\Entity\Order[] paginate($object = null, array $settings = [])
 */
class OrdersController extends AppController
{
    public $paginate = [
      'contain' => ['Products'],
      'limit' => 8
    ];
    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('RequestHandler');
        $this->loadModel('Products');
    }
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $orders = $this->paginate($this->Orders);

        $this->set(compact('orders'));
        $this->set('_serialize', ['orders']);
    }

//    public function search()
//    {       
//       if ($this->request->is('post'))
//       {
//          if(!empty($this->request->data) && isset($this->request->data) )
//          { 
//             $search_key = trim($this->request->data('keywords'));
//             $resultsArray = $this->Orders
//              ->find()
//              ->where(["orders.name LIKE" => "%".$search_key."%"]);
//              $orders = $this->paginate($resultsArray);
//              $this->set('orders',$orders);
//              $this->set('_serialize', ['orders']);
//              $this->render('index');
////              return $this->redirect(['action' => 'index']);
////              return $this->redirect($this->referer());
//          } 
//        } else {
//                $orders = $this->paginate($this->Orders);
//                $this->set('orders',$orders);
//                $this->set('_serialize', ['orders']);
//                $this->render('index');
//                }
//    }

    
    
    public function search()
    {
       if ($this->request->is('post'))
       {
          if(!empty($this->request->data) && isset($this->request->data) )
          {
             $search_key = trim($this->request->data('keywords'));
//             $conditions["orders.name LIKE"] = "%".$search_key."%";
             $conditions = ["orders.name LIKE" => "%".$search_key."%"];
             $this->request->session()->write('searchCond', $conditions);
             $this->request->session()->write('search_key', $search_key);
          }
       }
       //session set and read to make the pagination works for the search results.
       if ($this->request->session()->check('searchCond')) {
          $conditions = $this->request->session()->read('searchCond');
       } else {
          $conditions = null;
       }
       $sales = $this->Orders->find('all', [
                    'conditions' => $conditions
                ]);
       $this->set('orders',  $this->paginate($sales));
       $this->render('index');
    }
    
    
    
    public function refresh()
    {

//      return $this->redirect($this->referer());
        return $this->redirect(['action' => 'index']);

    }
    /**
     * View method
     *
     * @param string|null $id Order id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $order = $this->Orders->get($id, [
            'contain' => ['Products']
        ]);

        $this->set('order', $order);
        $this->set('_serialize', ['order']);
        $products = $this->Orders->Products->find('list', ['limit' => 200]);
        $this->set(compact('order', 'products'));
        $this->set('_serialize', ['order']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
//        $this->log($this->request->getData());
        $order = $this->Orders->newEntity();
        if ($this->request->is('post')) {
            $order = $this->Orders->patchEntity($order, $this->request->getData());
            if ($this->Orders->save($order)) {
                $this->Flash->success(__('The order has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The order could not be saved. Please, try again.'));
        }
        
//            $prod = $this->Orders->Products->findById($id)->toArray();$this->log(111);$this->log($prod);$this->log(222);
        $products = $this->Orders->Products->find('list', ['limit' => 200]);
//         debug($products->toArray());
//         $this->log($products);
//        $this->set('_serialize', ['prod']);
        $this->set(compact('order', 'products'));
        $this->set('_serialize', ['order']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Order id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $order = $this->Orders->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
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

    /**
     * Delete method
     *
     * @param string|null $id Order id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $order = $this->Orders->get($id);
        if ($this->Orders->delete($order)) {
            $this->Flash->success(__('The order has been deleted.'));
        } else {
            $this->Flash->error(__('The order could not be deleted. Please, try again.'));
        }
//        return $this->redirect($this->referer());
        return $this->redirect(['action' => 'index']);
    }

    public function approve($id = null)
    {
        $this->request->allowMethod(['post', 'approve']);
        $order = $this->Orders->get($id);
        $order->status = '1';
        if ($this->Orders->save($order)) {
            $this->Flash->success(__('The order has been approved.'));
        } else {
            $this->Flash->error(__('The order could not be approved. Please, try again.'));
        }
          return $this->redirect(['action' => 'index']);
//          return $this->redirect($this->referer());
    }

    public function product()
    {
        $this->request->allowMethod(['ajax']);
        if ($this->request->is('post'))
        {
          if(!empty($this->request->data) && isset($this->request->data) )
          {
            $id = $this->request->getData('id');
            $this->autoRender = false;
            $product = '111';
       ;
            $this->set(compact('product'));
            $this->set('_serialize', ['product']);
//            $this->log($product);
//            debug($product);
//          debug($this->Orders->Products->findById($id));
           //   $querys = $this->paginate($resultsArray);
//            $this->log($id);
//            $name=$this->Orders->Products->find()
//              ->select(['name'])
//              ->where(["products.id" => $id]);
//            $connection = ConnectionManager::get('default');
//         
//            $name = $connection->execute('select name from products where id= :id1', ['id1' =>$id])->fetchAll('assoc');
//                    
//            debug($name);
//            $this->log($name);
//            echo $name;
                 
//            $this->set('order',$data);
//            $this -> render('add');
//            $this->autoRender = false;
//             $this->set('_serialize', ['order']);
          }
        }
//        $products = $this->Orders->Products->find('list', ['limit' => 200]);
//        $this->set(compact('order', 'products'));
//        $this->set('_serialize', ['order']);
    }
    
     /**
     * get product method
     *
     * @param null
     * @return \Cake\Http\Response|to add.ctp ajax request.
     * @purpose when select product, get product info and fill into the form automatically
     */
    public function getproduct() {
        if($this->request->is('ajax')) { //Ajax request
            $id = $this->request->getData('productid'); //get para
//            $this->log($id);
            $product=$this->Orders->Products->get($id)->toArray();
//            $this->log($this->Orders->Products->get($id));
//            $this->log($product);
            $this->response = $this->response->withType('application/json') //setup response type
                ->withStringBody(json_encode(['name' => $product['name'],'description'=>$product['description']])); //set up respnose data
        }
        return $this->response; //return Cake\Http\Response object
    }
    
}
