<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Products Controller
 *
 * @property \App\Model\Table\ProductsTable $Products
 *
 * @method \App\Model\Entity\Product[] paginate($object = null, array $settings = [])
 */
class ProductsController extends AppController
{
    public $paginate = [
      'contain' => ['Categories'],
      'limit' => 8
    ];
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $products = $this->paginate($this->Products);
        $this->set(compact('products'));
        $this->set('_serialize', ['products']);
    }

//    public function search()
//    {       
//           if ($this->request->is('post'))
//           {
//              if(!empty($this->request->data) && isset($this->request->data) )
//              { 
//                 $search_key = trim($this->request->data('keywords'));
//                 $resultsArray = $this->Products
//                  ->find()
//                  ->where(["products.name LIKE" => "%".$search_key."%"]);
//                  $products = $this->paginate($resultsArray);
//                  $this->set('products',$products);
//                  $this->set('_serialize', ['products']);
//                  $this->render('index');
//    //              return $this->redirect(['action' => 'index']);
//    //              return $this->redirect($this->referer());
//              } 
//            } else {
//                    $products = $this->paginate($this->Products);
//                    $this->set('products',$products);
//                    $this->set('_serialize', ['products']);
//                    $this->render('index');
//                    }
//     }    

    public function search()
    {
       if ($this->request->is('post'))
       {
          if(!empty($this->request->data) && isset($this->request->data) )
          {
             $search_key = trim($this->request->data('keywords'));
             $conditions = ["products.name LIKE" => "%".$search_key."%"];
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
       $products = $this->Products->find('all', [
                    'conditions' => $conditions
                ]);
       $this->set('products',  $this->paginate($products));
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
     * @param string|null $id Product id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $product = $this->Products->get($id, [
            'contain' => ['Categories', 'Orders', 'Stocks']
        ]);

        $this->set('product', $product);
        $this->set('_serialize', ['product']);
        $categories = $this->Products->Categories->find('list', ['limit' => 200]);
        $this->set(compact('product', 'categories'));
        $this->set('_serialize', ['product']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $product = $this->Products->newEntity();
        if ($this->request->is('post')) {
            $product = $this->Products->patchEntity($product, $this->request->getData());
            if ($this->Products->save($product)) {
                $this->Flash->success(__('The product has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The product could not be saved. Please, try again.'));
        }
        $categories = $this->Products->Categories->find('list', ['limit' => 200]);
        $this->set(compact('product', 'categories'));
        $this->set('_serialize', ['product']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Product id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $product = $this->Products->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $product = $this->Products->patchEntity($product, $this->request->getData());
            if ($this->Products->save($product)) {
                $this->Flash->success(__('The product has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The product could not be saved. Please, try again.'));
        }
        $categories = $this->Products->Categories->find('list', ['limit' => 200]);
        $this->set(compact('product', 'categories'));
        $this->set('_serialize', ['product']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Product id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $product = $this->Products->get($id);
        if ($this->Products->delete($product)) {
            $this->Flash->success(__('The product has been deleted.'));
        } else {
            $this->Flash->error(__('The product could not be deleted. Please, try again.'));
        }
//        return $this->redirect($this->referer());
        return $this->redirect(['action' => 'index']);
    }
}
