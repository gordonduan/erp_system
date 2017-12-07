<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Stocks Controller
 *
 * @property \App\Model\Table\StocksTable $Stocks
 *
 * @method \App\Model\Entity\Stock[] paginate($object = null, array $settings = [])
 */
class StocksController extends AppController
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
    public function index()
    {
        $stocks = $this->paginate($this->Stocks);

        $this->set(compact('stocks'));
        $this->set('_serialize', ['stocks']);
    }

//    public function search()
//    {       
//       if ($this->request->is('post'))
//       {
//          if(!empty($this->request->data) && isset($this->request->data) )
//          { 
//             $search_key = trim($this->request->data('keywords'));
//             $resultsArray = $this->Stocks
//              ->find()
//              ->where(["stocks.name LIKE" => "%".$search_key."%"]);
//              $stocks = $this->paginate($resultsArray);
//              $this->set('stocks',$stocks);
//              $this->set('_serialize', ['stocks']);
//              $this->render('index');
//          } 
//        } else {
//                $stocks = $this->paginate($this->Stocks);
//                $this->set('stocks',$stocks);
//                $this->set('_serialize', ['stocks']);
//                $this->render('index');
//                }
//        }
    
    
    public function search()
    {
       if ($this->request->is('post'))
       {
          if(!empty($this->request->data) && isset($this->request->data) )
          {
             $search_key = trim($this->request->data('keywords'));
             $conditions = ["stocks.name LIKE" => "%".$search_key."%"];
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
       $stocks = $this->Stocks->find('all', [
                    'conditions' => $conditions
                ]);
       $this->set('stocks',  $this->paginate($stocks));
       $this->render('index');
    }        
      
      public function refresh()
      {

//        return $this->redirect($this->referer());
        return $this->redirect(['action' => 'index']);
      }
    /**
     * View method
     *
     * @param string|null $id Stock id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */

    public function view($id = null)
    {
        $stock = $this->Stocks->get($id, [
            'contain' => ['Products']
        ]);

        $this->set('stock', $stock);
        $this->set('_serialize', ['stock']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $stock = $this->Stocks->newEntity();
        if ($this->request->is('post')) {
            $stock = $this->Stocks->patchEntity($stock, $this->request->getData());
            if ($this->Stocks->save($stock)) {
                $this->Flash->success(__('The stock has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The stock could not be saved. Please, try again.'));
        }
        $products = $this->Stocks->Products->find('list', ['limit' => 200]);
        $this->set(compact('stock', 'products'));
        $this->set('_serialize', ['stock']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Stock id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $stock = $this->Stocks->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $stock = $this->Stocks->patchEntity($stock, $this->request->getData());
            if ($this->Stocks->save($stock)) {
                $this->Flash->success(__('The stock has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The stock could not be saved. Please, try again.'));
        }
        $products = $this->Stocks->Products->find('list', ['limit' => 200]);
        $this->set(compact('stock', 'products'));
        $this->set('_serialize', ['stock']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Stock id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $stock = $this->Stocks->get($id);
        if ($this->Stocks->delete($stock)) {
            $this->Flash->success(__('The stock has been deleted.'));
        } else {
            $this->Flash->error(__('The stock could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
