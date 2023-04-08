<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Papel Controller
 *
 *
 * @method \App\Model\Entity\Papel[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PapelController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $papel = $this->paginate($this->Papel);
        
       //deixar mensagem
       if($papel){
        return $this->response
        ->withType('application/json')
        ->withStatus(200)
        ->withStringBody(json_encode($papel));
        //$this->set(compact('papel'));
        
        }else{
            return $this->response
                ->withStatus(404)
                ->withType('application/json')
                ->withStringBody(json_encode(['msg'=>'Nenhum papel foi cadastrado.']));
                
        }
    }

    /**
     * View method
     *
     * @param string|null $id Papel id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $papel = $this->Papel
        ->find('all')
        ->where(['id'=> $id])
        ->toArray();

        if($papel){
           return $this->response
           ->withStatus(200)
            ->withType('application/json')
            ->withStringBody(json_encode($papel));
            
        }else{
         return  $this->response
           ->withStatus(404)
           ->withType('application/json')
           ->withStringBody(json_encode(['msg'=>'Este papel não existe.']));

        }
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        if($this->request->is(['ajax', 'post'])){

            $papel = $this->Papel->newEmptyEntity();
            $papel = $this->Papel->patchEntity($papel, $this->request);
           
                if ($this->Papel->save($papel)) {
                   // $this->Flash->success(__('O papel foi cadastrador com sucesso.'));
                    return $this->response
                    
                     ->withType('application/json')
                     ->withStatus(200)
                     ->withStringBody(json_encode(['msg','O papel  foi cadastrado com sucesso.']));
                   // return $this->redirect(['action' => 'index']);
                }else{
                return $this->response
                ->withStatus(400)
                 ->withType('application/json')
                 ->withStringBody(json_encode(['msg','O papel  foi cadastrado com sucesso.']));
                //$this->Flash->error(__('The papel could not be saved. Please, try again.'));
            }
    
            }
    }

    /**
     * Edit method
     *
     * @param string|null $id Papel id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $papel = $this->Papel->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $papel = $this->Papel->patchEntity($papel, $this->request->getData());
            if ($this->Papel->save($papel)) {
                $this->Flash->success(__('The papel has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The papel could not be saved. Please, try again.'));
        }
        $this->set(compact('papel'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Papel id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $papel = $this->Papel->get($id);
        if ($this->Papel->delete($papel)) {
            $this->Flash->success(__('The papel has been deleted.'));
        } else {
            $this->Flash->error(__('The papel could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
