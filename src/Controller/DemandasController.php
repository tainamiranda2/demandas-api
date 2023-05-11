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
        if($this->request->is(['post','ajax','patch'])){

            $demandas = $this->Demandas->newEntity();
            $demandas = $this->Demandas->patchEntity($demandas, $this->request->getData());
           
                if ($this->Demandas->save($demandas)) {
                  
                    return $this->response
                    
                     ->withType('application/json')
                     ->withStatus(200)
                     ->withStringBody(json_encode(['msg'=>'A demanda  foi cadastrado com sucesso.']));
                 
                }
                return $this->response
                ->withStatus(404)
                 ->withType('application/json')
                 ->withStringBody(json_encode(['msg'=>'A demanda não foi cadastrado.']));
              
    
            }
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
        if($this->request->is(['ajax','put'])){
            $demandas=$this->Demandas
                ->find('all')
                ->where(['id'=>$id])
                ->first();

            $demandas= $this->Demandas->patchEntity($demandas, $this->request->getData());
           
                if ($this->Demandas->save($demandas)) {
                  
                    return $this->response
                    
                     ->withType('application/json')
                     ->withStatus(200)
                     ->withStringBody(json_encode(['msg'=>'A demandas  foi atualizado com sucesso.']));
                 
                }
                return $this->response
                ->withStatus(404)
                 ->withType('application/json')
                 ->withStringBody(json_encode(['msg'=>'A demanda não foi atualizado.']));
    
            }
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
       
        $demandas=$this->Demandas
                ->find('all')
                ->where(['id'=>$id])
                ->first();
        if ($this->Demandas->delete($demandas)) {
            return $this->response
                    
            ->withType('application/json')
            ->withStatus(200)
            ->withStringBody(json_encode(['msg'=>'A demanda foi deletada com sucesso.']));
        } 
        return $this->response
        ->withStatus(404)
         ->withType('application/json')
         ->withStringBody(json_encode(['msg'=>'A demanda não foi deletado.']));
    }
    public function search()
    {
        if ($this->request->is('get')) { // Verifica se a solicitação é um GET
            $keyword = $this->request->getQuery('keyword'); // Obtém a palavra-chave de pesquisa da consulta GET
            
            $demandas = $this->Demandas->find()
                ->where(['nome_demanda LIKE' => '%' . $keyword . '%']) // Adapte essa condição de acordo com seus requisitos de pesquisa
                ->toArray();
            
            if ($demandas) {
                return $this->response
                    ->withType('application/json')
                    ->withStatus(200)
                    ->withStringBody(json_encode($demandas));
            } else {
                return $this->response
                    ->withStatus(404)
                    ->withType('application/json')
                    ->withStringBody(json_encode(['msg' => 'Nenhum demanda encontrado.']));
            }
        } else {
            return $this->response
                ->withStatus(405)
                ->withType('application/json')
                ->withStringBody(json_encode(['msg' => 'Método não permitido.']));
        }
    }
}
