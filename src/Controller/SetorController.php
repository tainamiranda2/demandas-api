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
        if($this->request->is(['post','ajax','patch'])){

            $setor = $this->Setor->newEntity();
            $setor = $this->Setor->patchEntity($setor, $this->request->getData());
           
                if ($this->Setor->save($setor)) {
                  
                    return $this->response
                    
                     ->withType('application/json')
                     ->withStatus(200)
                     ->withStringBody(json_encode(['msg'=>'O setor  foi cadastrado com sucesso.']));
                 
                }
                return $this->response
                ->withStatus(404)
                 ->withType('application/json')
                 ->withStringBody(json_encode(['msg'=>'O setor não foi cadastrado.']));
    
            }
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
        if($this->request->is(['ajax','put'])){
            $setor=$this->Setor
                ->find('all')
                ->where(['id'=>$id])
                ->first();

            $setor= $this->Setor->patchEntity($setor, $this->request->getData());
           
                if ($this->Setor->save($setor)) {
                  
                    return $this->response
                    
                     ->withType('application/json')
                     ->withStatus(200)
                     ->withStringBody(json_encode(['msg'=>'O setor  foi atualizado com sucesso.']));
                 
                }
                return $this->response
                ->withStatus(404)
                 ->withType('application/json')
                 ->withStringBody(json_encode(['msg'=>'O setor não foi atualizado.']));
    
            }
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
       
        $setor=$this->Setor
                ->find('all')
                ->where(['id'=>$id])
                ->first();
        if ($this->Setor->delete($setor)) {
            return $this->response
                    
            ->withType('application/json')
            ->withStatus(200)
            ->withStringBody(json_encode(['msg'=>'O setor foi deletado com sucesso.']));
        } 
        return $this->response
        ->withStatus(404)
         ->withType('application/json')
         ->withStringBody(json_encode(['msg'=>'O setor não foi deletado.']));
    }
      public function search()
    {
        if ($this->request->is('get')) { // Verifica se a solicitação é um GET
            $keyword = $this->request->getQuery('keyword'); // Obtém a palavra-chave de pesquisa da consulta GET
            
            $setor = $this->Setor->find()
                ->where(['nome_setor LIKE' => '%' . $keyword . '%']) // Adapte essa condição de acordo com seus requisitos de pesquisa
                ->toArray();
            
            if ($setor) {
                return $this->response
                    ->withType('application/json')
                    ->withStatus(200)
                    ->withStringBody(json_encode($setor));
            } else {
                return $this->response
                    ->withStatus(404)
                    ->withType('application/json')
                    ->withStringBody(json_encode(['msg' => 'Nenhum setor encontrado.']));
            }
        } else {
            return $this->response
                ->withStatus(405)
                ->withType('application/json')
                ->withStringBody(json_encode(['msg' => 'Método não permitido.']));
        }
    }
}
