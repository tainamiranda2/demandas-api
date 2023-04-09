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
        if($this->request->is(['post','ajax','patch'])){

            $papel = $this->Papel->newEntity();
            $papel = $this->Papel->patchEntity($papel, $this->request->getData());
           
                if ($this->Papel->save($papel)) {
                  
                    return $this->response
                    
                     ->withType('application/json')
                     ->withStatus(200)
                     ->withStringBody(json_encode(['msg'=>'O papel  foi cadastrado com sucesso.']));
                 
                }
                return $this->response
                ->withStatus(404)
                 ->withType('application/json')
                 ->withStringBody(json_encode(['msg'=>'O papel não foi cadastrado.']));
              
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
        if($this->request->is(['ajax','put'])){
            $papel=$this->Papel
                ->find('all')
                ->where(['id'=>$id])
                ->first();

            $papel = $this->Papel->patchEntity($papel, $this->request->getData());
           
                if ($this->Papel->save($papel)) {
                  
                    return $this->response
                    
                     ->withType('application/json')
                     ->withStatus(200)
                     ->withStringBody(json_encode(['msg'=>'O papel  foi atualizado com sucesso.']));
                 
                }
                return $this->response
                ->withStatus(404)
                 ->withType('application/json')
                 ->withStringBody(json_encode(['msg'=>'O papel não foi atualizado.']));
    
            }
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
       
        $papel=$this->Papel
                ->find('all')
                ->where(['id'=>$id])
                ->first();
        if ($this->Papel->delete($papel)) {
            return $this->response
                    
            ->withType('application/json')
            ->withStatus(200)
            ->withStringBody(json_encode(['msg'=>'O papel foi deletado com sucesso.']));
        } 
        return $this->response
        ->withStatus(404)
         ->withType('application/json')
         ->withStringBody(json_encode(['msg'=>'O papel não foi deletado.']));
      
    }
}
