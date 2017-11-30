<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Filesystem\Folder;
use Cake\Filesystem\File;

/**
 * Notices Controller
 *
 * @property \App\Model\Table\NoticesTable $Notices
 *
 * @method \App\Model\Entity\Notice[] paginate($object = null, array $settings = [])
 */
class NoticesController extends AppController
{
    public $paginate = [
          'limit' => 8
        ];
    
    public function initialize(){
        parent::initialize();
        // Load Files model
        $this->loadModel('Files');
        
    }
    
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $notices = $this->paginate($this->Notices);

        $this->set(compact('notices'));
        $this->set('_serialize', ['notices']);
    }
    
    public function refresh()
    {

      return $this->redirect($this->referer());

    }
    
    /**
     * View method
     *
     * @param string|null $id Notice id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $notice = $this->Notices->get($id, [
            'contain' => []
        ]);
//        $category=$this->Notices->find('list', ['keyField' => 'category','valueField' => 'name']);
        $category = [1 => 'Sales', 2 => 'Administration', 3 => 'HR', 4 => 'Finance', 5 => 'Business'];
//        debug($category->toArray());
        $this->set('notice', $notice);
        $this->set('category', $category);
        $this->set('_serialize', ['notice']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
//    public function add()
//    {
//        $notice = $this->Notices->newEntity();
//        if ($this->request->is('post')) {
//            $notice = $this->Notices->patchEntity($notice, $this->request->getData());
//            if ($this->Notices->save($notice)) {
//                $this->Flash->success(__('The notice has been saved.'));
//
//                return $this->redirect(['action' => 'index']);
//            }
//            $this->Flash->error(__('The notice could not be saved. Please, try again.'));
//        }
//
//        $this->set(compact('notice'));
//        $this->set('_serialize', ['notice']);
//    }

    /**
     * Edit method
     *
     * @param string|null $id Notice id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $notice = $this->Notices->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $notice = $this->Notices->patchEntity($notice, $this->request->getData());
            if ($this->Notices->save($notice)) {
                $this->Flash->success(__('The notice has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The notice could not be saved. Please, try again.'));
        }
        $category = [1 => 'Sales', 2 => 'Administration', 3 => 'HR', 4 => 'Finance', 5 => 'Business'];
        $this->set('category', $category);
        $this->set(compact('notice'));
        $this->set('_serialize', ['notice']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Notice id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $notice = $this->Notices->get($id);
        if ($this->Notices->delete($notice)) {
            $this->Flash->success(__('The notice has been deleted.'));
        } else {
            $this->Flash->error(__('The notice could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }    
    
    public function add(){
            $uploadData = '';
            
        if ($this->request->is('post')) {
             $category = trim($this->request->data('catid'));
             $name = trim($this->request->data('noticecat'));
             $title = trim($this->request->data('title'));
             $content = trim($this->request->data('content'));
             
            $uploadData = $this->Notices->newEntity();
            if(!empty($this->request->data['document']['name'])){ 
                $documentName = $this->request->data['document']['name'];
                $uploaddocumentPath = 'uploads/documents/';
                $uploaddocument = $uploaddocumentPath.$documentName;
                if(move_uploaded_file($this->request->data['document']['tmp_name'],$uploaddocument)){
                    $uploadData->document = $uploaddocument;
                }
            }
            if(!empty($this->request->data['image']['name'])){ 
                $imageName = $this->request->data['image']['name'];
                $uploadimagePath = 'uploads/images/';
                $uploadimage = $uploadimagePath.$imageName;
                if(move_uploaded_file($this->request->data['image']['tmp_name'],$uploadimage)){
                    $uploadData->image = $uploadimage;
                }
            }
            if(!empty($this->request->data['video']['name'])){ 
                $videoName = $this->request->data['video']['name'];
                $uploadvideoPath = 'uploads/videos/';
                $uploadvideo = $uploadvideoPath.$videoName;
                if(move_uploaded_file($this->request->data['video']['tmp_name'],$uploadvideo)){
                    $uploadData->video = $uploadvideo;
                }
            }
                    
                    $uploadData->category = $category;
                    $uploadData->name = $name;
                    $uploadData->title = $title;
                    $uploadData->content = $content;
                    $uploadData->created = date("Y-m-d H:i:s");
                    $uploadData->modified = date("Y-m-d H:i:s");
                    if ($this->Notices->save($uploadData)) {
                   //     $this->Flash->success(__('File has been uploaded and inserted successfully.'));
                        $this->Flash->success(__('The notice has been saved..'));
                        return $this->redirect(['action' => 'index']);
                    }else{
                    //    $this->Flash->error(__('Unable to upload file, please try again.'));
                        $this->Flash->error(__('The notice could not be saved. Please, try again.'));
                    }       
        }
        $this->set('notice',$uploadData);
//        $this->set('_serialize', ['notice']);
//            $this->set('uploadDocument', $uploadData);
//
//            $files = $this->Files->find('all', ['order' => ['Files.created' => 'DESC']]);
//            $filesRowNum = $files->count();
//            $this->set('files',$files);
//            $this->set('filesRowNum',$filesRowNum);
    
}

    public function search()
    {
       if ($this->request->is('post'))
       {
          if(!empty($this->request->data) && isset($this->request->data) )
          {
             if(!empty($this->request->data('catid'))) {
                $conditions['notices.category']=$this->request->data('catid');
             }
             if(!empty($this->request->data('keywords'))) {
                $conditions['notices.title like']="%".$this->request->data('keywords')."%";
             }
             $this->request->session()->write('searchCond', $conditions);
          }
       }
       if ($this->request->session()->check('searchCond')) {
          $conditions = $this->request->session()->read('searchCond');
       } else {
          $conditions = null;
       }
      $notices = $this->Notices->find('all', [
                    'conditions' => $conditions
                ]);
       
       $this->set('notices',  $this->paginate($notices));
       $this->render('index');
    }        

//
//    public function search(){
//
//           
//                    $query=array();
//                    if(!empty($this->request->data('catid'))) {
//                        $query['notices.category']=$this->request->data('catid');
//                    }
//                    if(!empty($this->request->data('keywords'))) {
//                        $query['notices.title like']="%".$this->request->data('keywords')."%";
//                    }
//                    $notices = $this->Notices->find('all', [
//                        'conditions' => $query
//                    ]);
//                   $notices = $this->paginate($notices);
//                   $this->set('notices', $notices);
//            
//    }
//public function search()
//{
//   if ($this->request->is('post'))
//   {
//      if(!empty($this->request->data) && isset($this->request->data) )
//      {
//         $search_key = trim($this->request->data['Post']['search_key']);
// 
//         $conditions[] = array(
//            "OR" => array(
//               "Post.title LIKE" => "%".$search_key."%",
//               "Post.body LIKE" => "%".$search_key."%"
//               )
//         );
// 
//         $this->Session->write('searchCond', $conditions);
//         $this->Session->write('search_key', $search_key);
//      }
//   }
// 
//   if ($this->Session->check('searchCond')) {
//      $conditions = $this->Session->read('searchCond');
//   } else {
//      $conditions = null;
//   }
// 
//   $this->Paginator->settings = array('all',
//      'conditions' => $conditions,
//      'limit' => 4
//   );
// 
//   $this->set('posts', $this->Paginator->paginate());
// 
//   $this->render('/Posts/index');
//}
}