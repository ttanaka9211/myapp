<?php

namespace App\Controller;

use Cake\Log\Log;
use DateTimeImmutable;

/**
 * Sales Controller.
 *
 * @property \App\Model\Table\SalesTable $Sales
 *
 * @method \App\Model\Entity\Sale[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class SalesController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('Paginator');
    }

    /**
     * Index method.
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Customers', 'Products'],
        ];
        $sales = $this->paginate($this->Sales);
        $this->set(compact('sales'));
        /* $query = $this->Sales
            ->find('search', ['search' => $this->request->getQuery()]);
        var_dump($query);
        $sales = $this->paginate($query); */

        $this->set(compact('sales'));
    }

    /**
     * View method.
     *
     * @param string|null $id sale id
     *
     * @return \Cake\Http\Response|null
     *
     * @throws \Cake\Datasource\Exception\RecordNotFoundException when record not found
     */
    public function view($id = null)
    {
        $sale = $this->Sales->get($id, [
            'contain' => ['Customers', 'Products'],
        ]);

        $this->set('sale', $sale);
    }

    /**
     * Add method.
     *
     * @return \Cake\Http\Response|null redirects on successful add, renders view otherwise
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
     * Edit method.
     *
     * @param string|null $id sale id
     *
     * @return \Cake\Http\Response|null redirects on successful edit, renders view otherwise
     *
     * @throws \Cake\Datasource\Exception\RecordNotFoundException when record not found
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
     * Delete method.
     *
     * @param string|null $id sale id
     *
     * @return \Cake\Http\Response|null redirects to index
     *
     * @throws \Cake\Datasource\Exception\RecordNotFoundException when record not found
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
            //$this->log($date, 'debug');
            $start = $date['start'];
            $end = $date['end'];

            $sales = $this->Sales->find()
                ->where([
                    'order_date_at >=' => $start,
                    'order_date_at <=' => $end,
                ])
                ->all();
            $this->log($sales, 'debug');
            $this->set(compact('sales'));
        }
    }

    public function find()
    {
        if ($this->request->is('get')) {
            //$start = $this->request->getQuery('start');
            //$end = $this->request->getQuery('end');
            //var_dump($start);
            $query = $this->Sales->find()
                ->where(function ($exp) {
                    return $exp->between('order_date_at', $this->request->getQuery('start'), $this->request->getQuery('end'));
                })
                //->toArray()
            ;
            //var_dump($query);
            $sales = $this->paginate($query);
            $this->set(compact('sales'));
        }
    }

    public function ranking()
    {
        $users = $this->Sales->find();

        $date_format = $users->func()->date_format([
        'order_date_at' => 'identifier',
        '"%Y/%m"' => 'identifier',
      ]);
        $users
      ->select([
        'oder_month' => $date_format,
        'price_total' => $users->func()->sum('product_price'),
      ])
      ->group('oder_month')
      ->toArray();
        var_dump($users);
    }

    public function chooseMonths()
    {
    }

    public function aggregate()
    {
        if ($this->request->is('get')) {
            $form = new DateTimeImmutable($this->request->getQuery('from'));
            $to = new DateTimeImmutable($this->request->getQuery('to'));
            $months = $this->Sales->getTargetMonths($form, $to);

            $aggregatedAccounts = $this->Sales->find(
            'crossAggregate',
            ['months' => $months]
            )
            ->toArray();
            var_dump($aggregatedAccounts);
            $this->set('accounts', $aggregatedAccounts);
            $this->set('months', $months);
            // $this->set('months', 'aggregatedAccounts');
            $this->log($aggregatedAccounts, 'debug');
            $this->log($months, 'debug');
        }
    }
}
