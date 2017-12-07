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

//      return $this->redirect($this->referer());
        return $this->redirect(['action' => 'index']);

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
        $documentPath=$notice->document;
        $imagePath=$notice->image;
        $videoPath=$notice->video;
        
        $category = [1 => 'Sales', 2 => 'Administration', 3 => 'HR', 4 => 'Finance', 5 => 'Business'];
        $this->set('category', $category);
        $this->set(compact('notice'));
        $this->set('_serialize', ['notice']);
        
        if ($this->request->is(['patch', 'post', 'put'])) {
            $uploadData = $this->Notices->patchEntity($notice, $this->request->getData());
            if (!empty($this->request->data['document']['name'])) {      //new document input
                $documentName = $this->request->data['document']['name'];
                $uploaddocumentPath = 'uploads/documents/';
                $uploaddocument = $uploaddocumentPath.$documentName;
                if (file_exists($uploaddocument)){                          //new imput exist, return
                    $this->Flash->error(__('The document already exist, please try again.'));
                    return $this->redirect(['action' => 'edit',$id]);
                } else {
                    if (!empty($documentPath) & file_exists($_SERVER['DOCUMENT_ROOT'] . '/erp/webroot/'.$documentPath)) {
                        unlink($_SERVER['DOCUMENT_ROOT'] . '/erp/webroot/'.$documentPath);  //delete old one
                    } 
                    move_uploaded_file($this->request->data['document']['tmp_name'],$uploaddocument); //upload new document
                    $uploadData->document = $uploaddocument;                        //pass new document path
                }
            } else {                                        //no new document input
                $uploadData->document = $documentPath;    //pass the old document path
            }
            
            if (!empty($this->request->data['image']['name'])) {      //new image input
                $imageName = $this->request->data['image']['name'];
                $uploadimagePath = 'uploads/images/';
                $uploadimage = $uploadimagePath.$imageName;
                if (file_exists($uploadimage)){                          //new imput exist, return
                    $this->Flash->error(__('The image already exist, please try again.'));
                    return $this->redirect(['action' => 'edit',$id]);
                } else {
                    if (!empty($imagePath) & file_exists($_SERVER['DOCUMENT_ROOT'] . '/erp/webroot/'.$imagePath)) {
                        unlink($_SERVER['DOCUMENT_ROOT'] . '/erp/webroot/'.$imagePath);  //delete old one
                    } 
                    move_uploaded_file($this->request->data['image']['tmp_name'],$uploadimage); //upload new image
                    $uploadData->image = $uploadimage;                                           //pass new image path
                }
            } else {                                    //no new image input
                $uploadData->image = $imagePath;    //pass the old image path
            }
            
            if (!empty($this->request->data['video']['name'])) {      //new video input
                $videoName = $this->request->data['video']['name'];
                $uploadvideoPath = 'uploads/videos/';
                $uploadvideo = $uploadvideoPath.$videoName;
                if (file_exists($uploadvideo)){                          //new imput exist, return
                    $this->Flash->error(__('The video already exist, please try again.'));
                    return $this->redirect(['action' => 'edit',$id]);
                } else {
                    if (!empty($videoPath) & file_exists($_SERVER['DOCUMENT_ROOT'] . '/erp/webroot/'.$videoPath)) {
                        unlink($_SERVER['DOCUMENT_ROOT'] . '/erp/webroot/'.$videoPath);  //delete old one
                    } 
                    move_uploaded_file($this->request->data['video']['tmp_name'],$uploadvideo); //upload new video
                    $uploadData->video = $uploadvideo;                                           //pass new video path
                }
            } else {                                                //no new video input
                $uploadData->video = $videoPath;    //pass the old video path
            }
 
            //update database
            if ($this->Notices->save($uploadData)) {
                $this->Flash->success(__('The notice has been saved.'));
                return $this->redirect(['action' => 'index']);
                } else {
                    $this->Flash->error(__('The notice could not be saved. Please, try again.'));
                }
            }
    }

    /**
     * Deletefile method
     *
     * @param string|null $id Notice id,string|null $filetype document/image/video.
     * @return \Cake\Http\Response|null Redirects to edit.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function deletefile($id = null, $filetype)
    { 
        $notice = $this->Notices->get($id);
        switch ($filetype)
            {
            case "document":
                if(!empty($notice->document) & file_exists($_SERVER['DOCUMENT_ROOT'] . '/erp/webroot/'.$notice->document)){
                    unlink($_SERVER['DOCUMENT_ROOT'] . '/erp/webroot/'.$notice->document); 
                    $notice->document = null;
                    $this->Notices->save($notice);
                    $this->Flash->success(__('The document has been deleted.'));
                    return $this->redirect(['action' => 'edit',$id]);
                }
                break;
            case "image":
                if(!empty($notice->image) & file_exists($_SERVER['DOCUMENT_ROOT'] . '/erp/webroot/'.$notice->imaage)){
                    unlink($_SERVER['DOCUMENT_ROOT'] . '/erp/webroot/'.$notice->image); 
                    $notice->image = null;
                    $this->Notices->save($notice);
                    $this->Flash->success(__('The image has been deleted.'));
                    return $this->redirect(['action' => 'edit',$id]);
                }
                break;
            case "video":
                if(!empty($notice->video) & file_exists($_SERVER['DOCUMENT_ROOT'] . '/erp/webroot/'.$notice->video)){
                    unlink($_SERVER['DOCUMENT_ROOT'] . '/erp/webroot/'.$notice->video); 
                    $notice->video = null;
                    $this->Notices->save($notice);
                    $this->Flash->success(__('The video has been deleted.'));
                    return $this->redirect(['action' => 'edit',$id]);
                }
                break;
            default:
                $this->Flash->error(__('The document is not exist, please try again.'));
            }
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
        
        if(!empty($notice->document)){
            if (!file_exists($_SERVER['DOCUMENT_ROOT'] . '/erp/webroot/'.$notice->document)){
                $this->Flash->error(__('The document is not exist, please try again.'));
                    return $this->redirect(['action' => 'index']);
            }
        }
        if(!empty($notice->image)){
            if (!file_exists($_SERVER['DOCUMENT_ROOT'] . '/erp/webroot/'.$notice->image)){
                $this->Flash->error(__('The image is not exist, please try again.'));
                    return $this->redirect(['action' => 'index']);
            }
        }
        if(!empty($notice->video)){
            if (!file_exists($_SERVER['DOCUMENT_ROOT'] . '/erp/webroot/'.$notice->video)){
                $this->Flash->error(__('The video is not exist, please try again.'));
                    return $this->redirect(['action' => 'index']);
            }
        }    
        if ($this->Notices->delete($notice)) {
            if(!empty($notice->document)){
                unlink($_SERVER['DOCUMENT_ROOT'] . '/erp/webroot/'.$notice->document);
            }
            if(!empty($notice->image)){
                unlink($_SERVER['DOCUMENT_ROOT'] . '/erp/webroot/'.$notice->image);
            }
            if(!empty($notice->video)){
                unlink($_SERVER['DOCUMENT_ROOT'] . '/erp/webroot/'.$notice->video);
            }
            $this->Flash->success(__('The notice has been deleted.'));
        } else {
            $this->Flash->error(__('The notice could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }    
    
    public function add(){
            $uploadData = '';
            //upload file
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
                if (file_exists($uploaddocument)){
                    $this->Flash->error(__('The document already exist, please try again.'));
                    return $this->redirect(['action' => 'add']);
                } else {
                    if(move_uploaded_file($this->request->data['document']['tmp_name'],$uploaddocument)){
                    $uploadData->document = $uploaddocument;
                }
                }
            }
            if(!empty($this->request->data['image']['name'])){ 
                $imageName = $this->request->data['image']['name'];
                $uploadimagePath = 'uploads/images/';
                $uploadimage = $uploadimagePath.$imageName;
                if (file_exists($uploadimage)){
                    $this->Flash->error(__('The image already exist, please try again.'));
                    return $this->redirect(['action' => 'add']);
                } else {
                    if(move_uploaded_file($this->request->data['image']['tmp_name'],$uploadimage)){
                    $uploadData->image = $uploadimage;
                }
                }
            }
            if(!empty($this->request->data['video']['name'])){ 
                $videoName = $this->request->data['video']['name'];
                $uploadvideoPath = 'uploads/videos/';
                $uploadvideo = $uploadvideoPath.$videoName;
                if (file_exists($uploadvideo)){
                    $this->Flash->error(__('The video already exist, please try again.'));
                    return $this->redirect(['action' => 'add']);
                } else {
                    if(move_uploaded_file($this->request->data['video']['tmp_name'],$uploadvideo)){
                    $uploadData->video = $uploadvideo;
                }
                }
            }
                    // udpate database
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
       //session set and read to make the pagination works for the search results.
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