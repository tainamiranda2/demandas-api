<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Demandas Controller
 *
 *
 * @method \App\Model\Entity\Demanda[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class DemandasController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $demandas = $this->paginate($this->Demandas);
        if($demandas){
            return $this->response
            ->withType('application/json')
            ->withStatus(200)
            ->withStringBody(json_encode($demandas));
            //$this->set(compact('papel'));
            
            }else{
                return $this->response
                    ->withStatus(404)
                    ->withType('application/json')
                    ->withStringBody(json_encode(['msg'=>'Nenhuma demanda foi cadastrado.']));
                    
            }
    }

    /**
     * View method
     *
     * @param string|null $id Demanda id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $demandas = $this->Demandas
        ->find('all')
        ->where(['id'=> $id])
        ->toArray();

        if($demandas){
           return $this->response
           ->withStatus(200)
            ->withType('application/json')
            ->withStringBody(json_encode($demandas));
            
        }else{
         return  $this->response
           ->withStatus(404)
           ->withType('application/json')
           ->withStringBody(json_encode(['msg'=>'Está demanda não existe.']));
        }
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $demanda = $this->Demandas->newEntity();
        if ($this->request->is('post')) {
            $demanda = $this->Demandas->patchEntity($demanda, $this->request->getData());
            if ($this->Demandas->save($demanda)) {
                $this->Flash->success(__('The demanda has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The demanda could not be saved. Please, try again.'));
        }
        $this->set(compact('demanda'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Demanda id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $demanda = $this->Demandas->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $demanda = $this->Demandas->patchEntity($demanda, $this->request->getData());
            if ($this->Demandas->save($demanda)) {
                $this->Flash->success(__('The demanda has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The demanda could not be saved. Please, try again.'));
        }
        $this->set(compact('demanda'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Demanda id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $demanda = $this->Demandas->get($id);
        if ($this->Demandas->delete($demanda)) {
            $this->Flash->success(__('The demanda has been deleted.'));
        } else {
            $this->Flash->error(__('The demanda could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
