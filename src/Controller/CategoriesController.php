<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Categories Controller
 *
 * @property \App\Model\Table\CategoriesTable $Categories
 *
 * @method \App\Model\Entity\Category[] paginate($object = null, array $settings = [])
 */
class CategoriesController extends AppController
{
    public $paginate = [
      'contain' => ['ParentCategories'],
      'limit' => 8
    ];

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $categories = $this->paginate($this->Categories);

        $this->set(compact('categories'));
        $this->set('_serialize', ['categories']);
    }
    
    public function treelist()
    {
        $list = $this->Categories->find('treeList');

        $this->set(compact('list'));
    }

//    public function search()
//    {
////      $this->log($this->request->data);
//       
//       if ($this->request->is('post'))
//       {
//          
//          if(!empty($this->request->data) && isset($this->request->data) )
//          { 
////              $this->log('333');
//     
//             $search_key = trim($this->request->data('keywords'));
//             $resultsArray = $this->Categories
//              ->find()
//              ->where(["categories.name LIKE" => "%".$search_key."%"]);
////                  debug($resultsArray->toArray());
//              $categories = $this->paginate($resultsArray);
//              $this->set('categories',$categories);
//              $this->set('_serialize', ['categories']);
//              $this->render('index');
////              return $this->redirect(['action' => 'index']);
////              return $this->redirect($this->referer());
//          } 
//    } else {
////              $this->log('444');
//        $categories = $this->paginate($this->Categories);
//        $this->set('categories',$categories);
//        $this->set('_serialize', ['categories']);
//        $this->render('index');
//        }
//    }
    
    public function search()
    {
       if ($this->request->is('post'))
       {
          if(!empty($this->request->data) && isset($this->request->data) )
          {
             $search_key = trim($this->request->data('keywords'));
//             $conditions["orders.name LIKE"] = "%".$search_key."%";
             $conditions = ["categories.name LIKE" => "%".$search_key."%"];
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
       $categories = $this->Categories->find('all', [
                    'conditions' => $conditions
                ]);
       $this->set('categories',  $this->paginate($categories));
       $this->render('index');
    }    

    public function batchdel()
    {
        $this->request->allowMethod(['post', 'delete']);
        if ($this->request->is('post'))
        {
           if(!empty($this->request->data) && isset($this->request->data))
           {
             $deleteid = $this->request->data('id');
             foreach ( $deleteid as $id ) {
                $this->delete($id);
             }
           }
        }
        return $this->redirect(['action' => 'index']);
    }

    public function refresh()
    {

//      return $this->redirect($this->referer());
        return $this->redirect(['action' => 'index']);

    }
    /**
     * View method
     *
     * @param string|null $id Category id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
//        $this->log('222');
        $category = $this->Categories->get($id, [
            'contain' => ['ParentCategories', 'ChildCategories', 'Products']
        ]);

        $this->set('category', $category);
        $this->set('_serialize', ['category']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $category = $this->Categories->newEntity();
        if ($this->request->is('post')) {
            $category = $this->Categories->patchEntity($category, $this->request->getData());
            if ($this->Categories->save($category)) {
                $this->Flash->success(__('The category has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The category could not be saved. Please, try again.'));
        }
        $parentCategories = $this->Categories->ParentCategories->find('list', ['limit' => 200]);
        $this->set(compact('category', 'parentCategories'));
        $this->set('_serialize', ['category']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Category id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $category = $this->Categories->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $category = $this->Categories->patchEntity($category, $this->request->getData());
            if ($this->Categories->save($category)) {
                $this->Flash->success(__('The category has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The category could not be saved. Please, try again.'));
        }
        $parentCategories = $this->Categories->ParentCategories->find('list', ['limit' => 200]);
        $this->set(compact('category', 'parentCategories'));
        $this->set('_serialize', ['category']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Category id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
//        $this->log('111');
        $category = $this->Categories->get($id);
//        debug($category);
        $productsCount=$this->Categories->Products->find()
                    ->where(["products.category_id" => $id])->count();
        $this->log($productsCount);
        if ($productsCount>0) {
            $this->Flash->warning(__('There are products in this category, it could not be deleted. Please try again.'));
            return $this->redirect(['action' => 'index']);
        }
        if ($this->Categories->delete($category)) {
            $this->Flash->success(__('The category has been deleted.'));
        } else {
            $this->Flash->error(__('The category could not be deleted. Please, try again.'));
        }
//        return $this->redirect($this->referer());
        return $this->redirect(['action' => 'index']);
    }
}
