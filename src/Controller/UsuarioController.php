<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Usuario Controller
 *
 *
 * @method \App\Model\Entity\Usuario[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsuarioController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $usuario = $this->paginate($this->Usuario);
        if($usuario){
            return $this->response
            ->withType('application/json')
            ->withStatus(200)
            ->withStringBody(json_encode($usuario));
            //$this->set(compact('papel'));
            
            }else{
                return $this->response
                    ->withStatus(404)
                    ->withType('application/json')
                    ->withStringBody(json_encode(['msg'=>'Nenhum usuário foi cadastrado.']));
                    
            }
    }

    /**
     * View method
     *
     * @param string|null $id Usuario id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $usuario = $this->Usuario
        ->find('all')
        ->where(['id'=> $id])
        ->toArray();

        if($usuario){
           return $this->response
           ->withStatus(200)
            ->withType('application/json')
            ->withStringBody(json_encode($usuario));
            
        }else{
         return  $this->response
           ->withStatus(404)
           ->withType('application/json')
           ->withStringBody(json_encode(['msg'=>'Este usúario não existe.']));

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

            $usuario = $this->Usuario->newEntity();
            $usuario = $this->Usuario->patchEntity($usuario, $this->request->getData());
           
                if ($this->Usuario->save($usuario)) {
                  
                    return $this->response
                    
                     ->withType('application/json')
                     ->withStatus(200)
                     ->withStringBody(json_encode(['msg'=>'O usuario foi cadastrado com sucesso.']));
                 
                }
                return $this->response
                ->withStatus(404)
                 ->withType('application/json')
                 ->withStringBody(json_encode(['msg'=>'O usuario não foi cadastrado.']));
              
    
            }
    }

    /**
     * Edit method
     *
     * @param string|null $id Usuario id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        if($this->request->is(['ajax','put'])){
            $usuario=$this->Usuario
                ->find('all')
                ->where(['id'=>$id])
                ->first();

            $usuario = $this->Usuario->patchEntity($usuario, $this->request->getData());
           
                if ($this->Usuario->save($usuario)) {
                  
                    return $this->response
                    
                     ->withType('application/json')
                     ->withStatus(200)
                     ->withStringBody(json_encode(['msg'=>'O usuario  foi atualizado com sucesso.']));
                 
                }
                return $this->response
                ->withStatus(404)
                 ->withType('application/json')
                 ->withStringBody(json_encode(['msg'=>'O usuario não foi atualizado.']));
    
            }
    }

    /**
     * Delete method
     *
     * @param string|null $id Usuario id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
       
        $usuario=$this->Usuario
                ->find('all')
                ->where(['id'=>$id])
                ->first();
        if ($this->Usuario->delete($usuario)) {
            return $this->response
                    
            ->withType('application/json')
            ->withStatus(200)
            ->withStringBody(json_encode(['msg'=>'O usuario foi deletado com sucesso.']));
        } 
        return $this->response
        ->withStatus(404)
         ->withType('application/json')
         ->withStringBody(json_encode(['msg'=>'O usuario não foi deletado.']));
    }

    public function search()
    {
        if ($this->request->is('get')) { // Verifica se a solicitação é um GET
            $keyword = $this->request->getQuery('keyword'); // Obtém a palavra-chave de pesquisa da consulta GET
            
            $usuarios = $this->Usuario->find()
                ->where(['nome LIKE' => '%' . $keyword . '%']) // Adapte essa condição de acordo com seus requisitos de pesquisa
                ->toArray();
            
            if ($usuarios) {
                return $this->response
                    ->withType('application/json')
                    ->withStatus(200)
                    ->withStringBody(json_encode($usuarios));
            } else {
                return $this->response
                    ->withStatus(404)
                    ->withType('application/json')
                    ->withStringBody(json_encode(['msg' => 'Nenhum usuário encontrado.']));
            }
        } else {
            return $this->response
                ->withStatus(405)
                ->withType('application/json')
                ->withStringBody(json_encode(['msg' => 'Método não permitido.']));
        }
    }
    

}