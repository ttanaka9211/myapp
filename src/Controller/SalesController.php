<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Log\Log;
use Cake\ORM\TableRegistry;

/**
 * Sales Controller
 *
 * @property \App\Model\Table\SalesTable $Sales
 *
 * @method \App\Model\Entity\Sale[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class SalesController extends AppController
{
    public $paginate = [
        'limit' => 3
    ];
    public function initialize()
    {
        parent::initialize();
        //検索処理のロード、アクション指定
        $this->loadComponent('Search.Prg', [
            'action' => ['index']
        ]);
    }
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        /* $this->paginate = [
            'contain' => ['Customers', 'Products'],
        ];
        $sales = $this->paginate($this->Sales);
        $this->set(compact('sales')); */
        $query = $this->Sales
            ->find('search', ['search' => $this->request->getQuery()]);
        var_dump($query);
        $sales = $this->paginate($query);

        $this->set(compact('sales'));
    }


    /**
     * View method
     *
     * @param string|null $id Sale id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $sale = $this->Sales->get($id, [
            'contain' => ['Customers', 'Products'],
        ]);

        $this->set('sale', $sale);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $sale = $this->Sales->newEntity();
        if ($this->request->is('post')) {
            $sale = $this->Sales->patchEntity($sale, $this->request->getData());
            if ($this->Sales->save($sale)) {
                $this->Flash->success(__('The sale has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The sale could not be saved. Please, try again.'));
        }
        $customers = $this->Sales->Customers->find('list', ['limit' => 200]);
        $products = $this->Sales->Products->find('list', ['limit' => 200]);
        $this->set(compact('sale', 'customers', 'products'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Sale id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $sale = $this->Sales->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $sale = $this->Sales->patchEntity($sale, $this->request->getData());
            if ($this->Sales->save($sale)) {
                $this->Flash->success(__('The sale has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The sale could not be saved. Please, try again.'));
        }
        $customers = $this->Sales->Customers->find('list', ['limit' => 200]);
        $products = $this->Sales->Products->find('list', ['limit' => 200]);
        $this->set(compact('sale', 'customers', 'products'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Sale id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $sale = $this->Sales->get($id);
        if ($this->Sales->delete($sale)) {
            $this->Flash->success(__('The sale has been deleted.'));
        } else {
            $this->Flash->error(__('The sale could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    public function sale()
    {
        //データ確認
        $sale = $this->request->getData();
        $this->set(compact('sale'));

        //保存
        $sale = $this->request->getData();
        //Log::write('debug', $sale);
        $sale = $this->Sales->newEntity();
        //debug($sale);
        if ($this->request->isPost()) {
            $sale = $this->Sales->patchEntity($sale, $this->request->getData());
            if ($this->Sales->save($sale)) {

                $this->Flash->success(__('The customer has been saved.'));

                return $this->redirect(['action' => 'index']);
            } //else {
            //$this->log(print_r($sale->getErrors(), true), LOG_DEBUG);
            //}
            //$this->log($sale);
            $this->Flash->error(__('The customer could not be saved. Please, try again.'));
        }
        $this->set(compact('sale'));

        // return $this->redirect(['controller' => 'Sales', 'action' => 'index']);
    }

    public function search()
    {
        if ($this->request->isPost()) {
            $date = $this->request->getData();
            $this->log($date, 'debug');
            try {
                $query = $this->Sales->find()
                    ->where([
                        'order_date_at >=' => $date['start'],
                        'order_date_at <=' => $date['end'],
                    ])
                    ->toArray();
            } catch (\Exception $e) {
                $this->log($e->getErrors, 'debug');
            }
            $this->log($query, 'debug');

            $sales = $this->paginate($query);
            $this->set(compact('sales'));
        }
    }
}