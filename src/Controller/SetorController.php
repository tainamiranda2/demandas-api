<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Setor Controller
 *
 *
 * @method \App\Model\Entity\Setor[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class SetorController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $setor = $this->paginate($this->Setor);
        if($setor){
            return $this->response
            ->withType('application/json')
            ->withStatus(200)
            ->withStringBody(json_encode($setor));
            //$this->set(compact('papel'));
            
            }else{
                return $this->response
                    ->withStatus(404)
                    ->withType('application/json')
                    ->withStringBody(json_encode(['msg'=>'Nenhum setor foi cadastrado.']));
                    
            }
    }

    /**
     * View method
     *
     * @param string|null $id Setor id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $setor = $this->Setor
        ->find('all')
        ->where(['id'=> $id])
        ->toArray();

        if($setor){
           return $this->response
           ->withStatus(200)
            ->withType('application/json')
            ->withStringBody(json_encode($setor));
            
        }else{
         return  $this->response
           ->withStatus(404)
           ->withType('application/json')
           ->withStringBody(json_encode(['msg'=>'Este setor não existe.']));

        }
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $setor = $this->Setor->newEntity();
        if ($this->request->is('post')) {
            $setor = $this->Setor->patchEntity($setor, $this->request->getData());
            if ($this->Setor->save($setor)) {
                $this->Flash->success(__('The setor has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The setor could not be saved. Please, try again.'));
        }
        $this->set(compact('setor'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Setor id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $setor = $this->Setor->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $setor = $this->Setor->patchEntity($setor, $this->request->getData());
            if ($this->Setor->save($setor)) {
                $this->Flash->success(__('The setor has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The setor could not be saved. Please, try again.'));
        }
        $this->set(compact('setor'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Setor id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $setor = $this->Setor->get($id);
        if ($this->Setor->delete($setor)) {
            $this->Flash->success(__('The setor has been deleted.'));
        } else {
            $this->Flash->error(__('The setor could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
