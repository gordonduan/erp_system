<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Datasource\ConnectionManager;
/**
 * Sales Controller
 *
 * @property \App\Model\Table\SalesTable $Sales
 *
 * @method \App\Model\Entity\Sale[] paginate($object = null, array $settings = [])
 */
class SalesController extends AppController
{
    public $paginate = [
      'contain' => ['Products', 'Categories'],
      'limit' => 8
    ];
    
    public function initialize()
    {
        // Always enable the CSRF component.
        $this->loadModel('Categories');
        $this->loadModel('Products');
 
    }
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {       
        $sales = $this->paginate($this->Sales);
        $products = $this->Sales->Products->find('list', ['limit' => 200]);//$this->log(111);//$this->log($products);
        $categories = $this->Sales->Categories->find('list', ['limit' => 200]);//$this->log(444);
        $this->set(compact('sales', 'products', 'categories'));
        $this->set('_serialize', ['sale', 'prod']);
    }

    /**
     * View method
     *
     * @param string|null $id Sale id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $sale = $this->Sales->get($id, [
            'contain' => ['Products', 'Categories']
        ]);

        $this->set('sale', $sale);
        $this->set('_serialize', ['sale']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {

        $products = $this->Sales->Products->find('list', ['limit' => 200]);$this->log(111);//$this->log($products);
        
        if ($this->request->is('post')) {
            
            $id = $this->request->getData('id');
            if (!$id) { $id = 0; }
            $prod = $this->Sales->Products->findById($id)->toArray();$this->log(222);//$this->log($prod);
        
        
//            $sale = $this->Sales->newEntity();
//            $sale = $this->Sales->patchEntity($sale, $this->request->getData());
//            if ($this->Sales->save($sale)) {
//                $this->Flash->success(__('The sale has been saved.'));
//
//                return $this->redirect(['action' => 'index']);
//            }
            $this->log(333);
            $this->Flash->error(__('The sale could not be saved. Please, try again.'));
        }
        $categories = $this->Sales->Categories->find('list', ['limit' => 200]);$this->log(444);
        $this->set(compact('sale', 'products', 'categories', 'prod'));
        $this->set('_serialize', ['sale', 'prod']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Sale id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $sale = $this->Sales->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $sale = $this->Sales->patchEntity($sale, $this->request->getData());
            if ($this->Sales->save($sale)) {
                $this->Flash->success(__('The sale has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The sale could not be saved. Please, try again.'));
        }
        $products = $this->Sales->Products->find('list', ['limit' => 200]);
        $categories = $this->Sales->Categories->find('list', ['limit' => 200]);
        $this->set(compact('sale', 'products', 'categories'));
        $this->set('_serialize', ['sale']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Sale id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $sale = $this->Sales->get($id);
        if ($this->Sales->delete($sale)) {
            $this->Flash->success(__('The sale has been deleted.'));
        } else {
            $this->Flash->error(__('The sale could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    
    public function refresh()
    {

      return $this->redirect($this->referer());

    }    
    
    
    public function search()
    {
       if ($this->request->is('post'))
       {
          if(!empty($this->request->data) && isset($this->request->data) )
          {
               $parent_id = trim($this->request->data('category_id'));
                $conditions=array();
                if(!empty($this->request->data('category_id'))) {
                    $parent_id=$this->request->data('category_id');
                    $id = $this->Sales->Categories->find('list', [
                        'limit' =>200,
                        'keyField' => 'id',
                        'valueField' => ['id']
                      ])->where(['OR' => [["categories.parent_id" => $parent_id], ["categories.id" => "$parent_id"]]]);
                    $id=array_values($id->toArray());
                    $conditions['sales.category_id in']=$id;
                }
                if(!empty($this->request->data('product_id'))) {
                    $conditions['sales.product_id']=$this->request->data('product_id');
                }
                if(!empty($this->request->data('keywords'))) {
                    $conditions['sales.name like']="%".$this->request->data('keywords')."%";
                }
             $this->request->session()->write('searchCond', $conditions);
          }
       }
       if ($this->request->session()->check('searchCond')) {
          $conditions = $this->request->session()->read('searchCond');
       } else {
          $conditions = null;
       }
      $sales = $this->Sales->find('all', [
                    'conditions' => $conditions
                ]);
       
       $products = $this->Sales->Products->find('list', ['limit' => 200]);
       $categories = $this->Sales->Categories->find('list', ['limit' => 200]);
       $this->set('sales',  $this->paginate($sales));
       $this->set('products',$products);
       $this->set('categories', $categories);
       $this->render('index');
    }        
    
//    public function search()
//      {
////        $sales = $this->paginate($this->Sales);
////
//////        $this->set(compact('sales'));
////        $this->set('_serialize', ['sales']);
////        $categories = $this->Sales->find('list', ['limit' => 200]);
////        $this->set(compact('sales', 'categories'));
////        //$this->set('_serialize', ['product']);
////        
////        $products = $this->Sales->Products->find('list', ['limit' => 200]);//$this->log(111);//$this->log($products);
////        $categories = $this->Sales->Categories->find('list', ['limit' => 200]);//$this->log(444);
////        $this->set(compact('sale', 'products', 'categories', 'prod'));
////        $this->set('_serialize', ['sale', 'prod']);
//        
//         if ($this->request->is('post'))
//         {
////            $this->log('111');
////            $this->log($this->request->data);
//            if(!empty($this->request->data) && isset($this->request->data) )
//            {
////               $parent_id = trim($this->request->data('category_id'));
//                $query=array();
//                if(!empty($this->request->data('category_id'))) {
//                    $parent_id=$this->request->data('category_id');
//                    $id = $this->Sales->Categories->find('list', [
//                        'limit' =>200,
//                        'keyField' => 'id',
//                        'valueField' => ['id']
//                      ])->where(['OR' => [["categories.parent_id" => $parent_id], ["categories.id" => "$parent_id"]]]);
//                    $id=array_values($id->toArray());
//                    $query['sales.category_id in']=$id;
//                }
//                if(!empty($this->request->data('product_id'))) {
//                    $query['sales.product_id']=$this->request->data('product_id');
//                }
//                if(!empty($this->request->data('keywords'))) {
//                    $query['sales.name like']="%".$this->request->data('keywords')."%";
//                }
////                debug($query);
//                $sales = $this->Sales->find('all', [
//                    'conditions' => $query
//                ]);
//               $sales = $this->paginate($sales);
//               $products = $this->Sales->Products->find('list', ['limit' => 200]);
//               $categories = $this->Sales->Categories->find('list', ['limit' => 200]);
//               $this->set(compact('sales','products','categories'));
//         }
//      } else {
//              $sales = $this->paginate($this->Sales);
//              $products = $this->Sales->Products->find('list', ['limit' => 200]);//$this->log(111);//$this->log($products);
//              $categories = $this->Sales->Categories->find('list', ['limit' => 200]);//$this->log(444);
//              $this->set(compact('sales', 'products', 'categories'));
//              $this->set('_serialize', ['sale', 'prod']);
//             }
//}
}


//               $parent_id = (empty($this->request->data('category_id')))? '1=1' : $this->request->data('category_id');
//               $product_id = (empty($this->request->data('product_id')))? '1=1' : $this->request->data('product_id');
//               $name = (empty($this->request->data('keywords')))? '1=1' : "%".$this->request->data('keywords')."%";
//               echo ($parent_id);
//               $this->log($product_id);
//               $this->log($name);
//               $resultsArray = $this->Sales
//              ->find()
//              ->where(["categories.name LIKE" => "%".$name."%"]);
               
//               $connection = ConnectionManager::get('default');
//               $id=$connection->execute('(select id from categories where parent_id = :id or id=:id)', ['id' =>$parent_id])->fetchAll('assoc');
//               $sales = $connection->execute('select * from sales where category_id in (select id from categories where parent_id = :id or id=:id) and product_id= :id1 and name like :id2', ['id' =>$parent_id,'id1'=>$product_id,'id2'=>$name])->fetchAll('assoc');
//               $sales = $connection->execute('select * from sales where category_id in (select id from categories where parent_id = :id or id=:id)', ['id' =>$parent_id])->fetchAll('assoc');
//              $id=array(13,20,21);
//               var_dump($id);
//               var_dump(array_values($id));
//              $id= $this->Sales->Categories->find('list', ['limit' => 200])
//                      ->where(['OR' => [["categories.parent_id" => $parent_id], ["categories.id" => "$parent_id"]]]);
//              debug($id->toArray());
//              print_r(array_values($id->toArray()));
//                $id = $this->Sales->Categories->find('list', [
//                        'limit' =>200,
//                        'keyField' => 'id',
//                        'valueField' => ['id']
//                      ])->where(['OR' => [["categories.parent_id" => $parent_id], ["categories.id" => "$parent_id"]]]);
//                $id=array_values($id->toArray());
//                debug($id);
//                debug($product_id);
//                debug($name);
//                debug($id->toArray());
//                debug(array_values($id->toArray()));
//                $id=array_values($id->toArray());
//                print_r($id);
                
//                $sales = $this->Sales
//                ->find()
//                ->where(["sales.category_id in" => $id]);
//                $sales = $this->Sales->find('all', [
//                    'conditions' => ["sales.category_id in" => $id]
//                ]);
              
                
                
//                $sales = $this->Sales
//                ->find()
//                ->where(["sales.category_id in" => $id,
//                        "sales.product_id" => $product_id,
//                        "sales.name LIKE" => $name]);
//              debug($sales->toArray());
//              $id = $this->Sales->Categories
//                ->find('list', [
//                                    'keyField' => 'categories.id',
//                                    'valueField' => 'categories.name'
//                                ])
//                ->where(['OR' => [["categories.parent_id" => $parent_id], ["categories.id" => "$parent_id"]]]);
  
//              debug($id->toArray());
//               $this->log($id);
//               debug($id);
//               print_r($id);
//               print_r(array_values($id));
//               $id=$id->toArray();
//               $this->log($id);
//               debug($id);
//               $sales = $this->Sales
//              ->find()
//              ->where(["sales.category_id in" => $id]);
//               $this->log($sales);
//               if (isset($parent_id)){
//                   $results = $connection->execute('select * from sales where category_id in (select id from categories where parent_id = :id or id=:id)', ['id' =>$parent_id])->fetchAll('assoc');
//                   return;
//                   if (isset($product_id)){
//                       $results = $connection->execute('select * from sales where category_id in (select id from categories where parent_id = :id or id=:id) and product_id= :id1', ['id' =>$parent_id,'id1'=>$product_id])->fetchAll('assoc');
//                       return;
//                       if (isset($name)){
//                           $results = $connection->execute('select * from sales where category_id in (select id from categories where parent_id = :id or id=:id) and product_id= :id1 and name like :id2', ['id' =>$parent_id,'id1'=>$product_id,'id2'=>$name])->fetchAll('assoc');
//                           reutrn;
//                       }
//                   }
//               }
               
//                $this->log($results);  
//                debug($results);
                
//               $this->log($name);
//               $this-log($product_id);
//               $categories_id = $this->Sales->Categories
//                ->find()
//                ->select('id')
//                ->where(['OR' => [["categories.parent_id" => $parent_id], ["categories.id" => "$parent_id"]]]);
               
//                $dsn = "mysql://root:''@localhost/cake_erp";
//                ConnectionManager::config('default', ['url' => $dsn]);
//                $connection = ConnectionManager::get('default');
//                $results = $connection->execute('select id from sales where category_id in (select id from categories where parent_id = :id or id=:id) and sales.product_id = :product_id and sales.name like :name', ['id' =>$parent_id],['product_id' =>$product_id],['name' =>$name])->fetchAll('assoc');
//                $results = $connection->execute('select * from sales where category_id in (select id from categories where parent_id = :id or id=:id)', ['id' =>$parent_id])->fetchAll('assoc');
//                $results = $connection->execute('select * from sales where category_id in (select id from categories where parent_id = :id or id=:id) and product_id= :id1', ['id' =>$parent_id,'id1'=>$product_id])->fetchAll('assoc');
                
//                $results = $connection->execute('select id from categories where parent_id = :id or id=:id', ['id' =>$parent_id])->fetchAll('assoc');
//                $data = $results->toArray();
                
//                $this->log($data);  
//                $this->log($results);  
//                debug($results);
//               $data = $query->toArray();
//               $categories_id = $this->Sales->Categories->query('select id from categories where parent_id =$parent_id or id=$parent_id');
//                    
//               $this->log($categories_id);  
//               debug($categories_id);
               
               
               
//               $this->log($parent_id);
               
//               $product_id = trim($this->request->data('product_id'));
//               $name=trim($this->request->data('keywords'));
//               $resultsArray = $results
//                ->find()
//                ->where(["sales.category_id in" => $data,
//                        "sales.product_id" => $product_id,
//                        "sales.name LIKE" => "%".$name."%"]);
//                debug($resultsArray);
//                 $this->log($resultsArray);
//                $sales = $this->paginate($results);
           
//                $products = $this->Sales->Products->find('list', ['limit' => 200]);//$this->log(111);//$this->log($products);
//                $categories = $this->Sales->Categories->find('list', ['limit' => 200]);//$this->log(444);
//                $this->set(compact('sales', 'products', 'categories', 'prod'));
//                $this->set('_serialize', ['sale', 'prod']);
      //          $this->render('index');
//                return $this->redirect($this->referer());
//            }
//          }