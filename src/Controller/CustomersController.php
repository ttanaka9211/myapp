<?php

namespace App\Controller;

use App\Controller\AppController;
use App\Model\Entity\Customer;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;

/**
 * Customers Controller
 *
 * @property \App\Model\Table\CustomersTable $Customers
 *
 * @method \App\Model\Entity\Customer[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CustomersController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->Products = TableRegistry::getTableLocator()->get('products');
    }
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $productsAll = $productsVaild = array();
        foreach ($this->Products->find()->all() as $tmp) {
            $productsAll += array($tmp->id => $tmp->name);
            if ($tmp->delete_flag != '1') {
                $productsVaild += array($tmp->id => $tmp->name);
            }
        }
        $this->set(compact('productsAll', 'productsVaild'));
    }

    public function isAuthorized($user)
    {
        return true;
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $customers = $this->paginate($this->Customers);

        $this->set(compact('customers'));
    }

    /**
     * View method
     *
     * @param string|null $id Customer id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $customer = $this->Customers->get($id, [
            'contain' => [],
        ]);

        $this->set('customer', $customer);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $customer = $this->Customers->newEntity();
        if ($this->request->is('post')) {
            $customer = $this->Customers->patchEntity($customer, $this->request->getData());
            if ($this->Customers->save($customer)) {
                $this->Flash->success(__('The customer has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The customer could not be saved. Please, try again.'));
        }
        $this->set(compact('customer'));
    }

    public function find()
    {
        $customers = [];
        if ($this->request->isPost()) {
            $requestData = $this->request->getData();
            $conditions = [];
            if (!empty($requestData['first_name like'])) {
                $conditions['first_name like'] = $requestData['first_name'] . '%';
            }
            if (!empty($requestData['last_name'])) {
                $conditions['last_name like'] = $requestData['last_name'] . '%';
            }
            if (!empty($requestData['telephone_number'])) {
                $conditions['telephone_number like'] = $requestData['telephone_number'] . '%';
            }
            $customers = $this->Customers->find()
                ->where($conditions);
            $this->set('msg', "電話番号で検索出来ます（あいまい検索も可能）");
            $this->set('customers', $customers);
        }
    }

    public function order($id = null)
    {
        $client = $this->Customers->get($id, [
            'contain' => [],
        ]);
        $this->set('client', $client);

        $this->loadModel('Sales');

        $customer = $this->Sales->newEntity();
        if ($this->request->isPost()) {
            $customer = $this->Sales->patchEntity($customer, $this->request->getData());
            if ($this->Sales->save($customer)) {
                $this->Flash->success(__('The customer has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The customer could not be saved. Please, try again.'));
        }
        $this->set(compact('customer'));
        log($customer);
        //return $this->redirect(['action' => 'sale']);
    }
    // public function sale()
    // {
    //     log($client);
    //     // $client = $this->Customers->get($id, [
    //     //     'contain' => [],
    //     // ]);
    //     // $this->set('client', $client);
    //     $this->loadModel('Sales');

    //     $customer = $this->Sales->newEntity();
    //     if ($this->request->isPost()) {
    //         $customer = $this->Sales->patchEntity($customer, $this->request->getData());
    //         if ($this->Sales->save($customer)) {
    //             $this->Flash->success(__('The customer has been saved.'));

    //             return $this->redirect(['action' => 'index']);
    //         }
    //         $this->Flash->error(__('The customer could not be saved. Please, try again.'));
    //     }
    //     $this->set(compact('customer', 'client'));

    //     //return $this->redirect(['controller' => 'Sales', 'action' => 'add']);
    // }

    /**
     * Edit method
     *
     * @param string|null $id Customer id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    /* public function edit($id = null)
    {
        $customer = $this->Customers->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $customer = $this->Customers->patchEntity($customer, $this->request->getData());
            if ($this->Customers->save($customer)) {
                $this->Flash->success(__('The customer has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The customer could not be saved. Please, try again.'));
        }
        $this->set(compact('customer'));
    } */

    /**
     * Delete method
     *
     * @param string|null $id Customer id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    /*  public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $customer = $this->Customers->get($id);
        if ($this->Customers->delete($customer)) {
            $this->Flash->success(__('The customer has been deleted.'));
        } else {
            $this->Flash->error(__('The customer could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    } */
}