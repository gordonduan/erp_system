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

    public function search()
    {
       if ($this->request->is('post'))
       {
          if(!empty($this->request->data) && isset($this->request->data) )
          {
             $search_key = trim($this->request->data('keywords'));
             $resultsArray = $this->Orders
              ->find()
              ->where(["orders.name LIKE" => "%".$search_key."%"]);
              $querys = $this->paginate($resultsArray);
              $this->set('orders',$querys);
              $this->render('index');
          }
        }
    }

    public function refresh()
    {

      return $this->redirect($this->referer());

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
        $products = $this->Orders->Products->find('list', ['limit' => 200]);
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
        return $this->redirect($this->referer());
      //  return $this->redirect(['action' => 'index']);
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
    //      return $this->redirect(['action' => 'index']);
          return $this->redirect($this->referer());
    }

    public function product()
    {
        $id = $this->request->getData('id');
//        $this->log($id);
        if ($this->request->is('post'))
        {
          if(!empty($this->request->data) && isset($this->request->data) )
          {
              
         // debug($this->Orders->Products->findById($id));
           //   $querys = $this->paginate($resultsArray);
            $data=$this->Orders->Products->findById($id);
        
            debug($data);
            $this->set('order',$data);
//            $this -> render('add');
//            $this->autoRender = false;
          }
        }
//        $products = $this->Orders->Products->find('list', ['limit' => 200]);
//        $this->set(compact('order', 'products'));
//        $this->set('_serialize', ['order']);
    }
    
}
