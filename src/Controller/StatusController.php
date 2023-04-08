<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Status Controller
 *
 *
 * @method \App\Model\Entity\Status[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class StatusController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $status = $this->paginate($this->Status);
        if($status){
            return $this->response
            ->withType('application/json')
            ->withStatus(200)
            ->withStringBody(json_encode($status));
            //$this->set(compact('papel'));
            
            }else{
                return $this->response
                    ->withStatus(404)
                    ->withType('application/json')
                    ->withStringBody(json_encode(['msg'=>'Nenhum status foi cadastrado.']));
                    
            }
    }

    /**
     * View method
     *
     * @param string|null $id Status id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $status = $this->Status
        ->find('all')
        ->where(['id'=> $id])
        ->toArray();

        if($status){
           return $this->response
           ->withStatus(200)
            ->withType('application/json')
            ->withStringBody(json_encode($status));
            
        }else{
         return  $this->response
           ->withStatus(404)
           ->withType('application/json')
           ->withStringBody(json_encode(['msg'=>'Este status não existe.']));

        }
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        if($this->request->is(['post','ajax','patch'])){

            $status = $this->Status->newEntity();
            $status = $this->Status->patchEntity($status, $this->request->getData());
           
                if ($this->Status->save($status)) {
                  
                    return $this->response
                    
                     ->withType('application/json')
                     ->withStatus(200)
                     ->withStringBody(json_encode(['msg'=>'O status  foi cadastrado com sucesso.']));
                 
                }
                return $this->response
                ->withStatus(404)
                 ->withType('application/json')
                 ->withStringBody(json_encode(['msg'=>'O status não foi cadastrado.']));
              
            
    
            }
    }

    /**
     * Edit method
     *
     * @param string|null $id Status id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $status = $this->Status->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $status = $this->Status->patchEntity($status, $this->request->getData());
            if ($this->Status->save($status)) {
                $this->Flash->success(__('The status has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The status could not be saved. Please, try again.'));
        }
        $this->set(compact('status'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Status id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $status = $this->Status->get($id);
        if ($this->Status->delete($status)) {
            $this->Flash->success(__('The status has been deleted.'));
        } else {
            $this->Flash->error(__('The status could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
