<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Log\Log;
use Cake\ORM\TableRegistry;
use Cake\Datasource\ConnectionManager;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 *
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsersController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $users = $this->paginate($this->Users);

        $this->set(compact('users'));
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => [],
        ]);

        $this->set('user', $user);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function export()
    {
        $header = array("出席番号", "名前", "身長");
        $datas = array(
            array(1, "山田太郎", 167), array(2, "鈴木花子", 158), array(3, "高橋健太", 174)
        );

        $temp_dir = sys_get_temp_dir();
        //$this->log($temp_dir, 'debug');
        $temp_csv_file_path = tempnam($temp_dir, 'temp_csv');
        //$this->log($temp_csv_file_path);
        $fp = fopen($temp_csv_file_path, 'w');
        fputcsv($fp, $header);

        foreach ($datas as $data) {
            $row = array(
                $data[0], $data[2], $data[3], $data[4]
            );
            fputcsv($fp, $data);
        }
        fclose($fp);
        $this->log($fp, 'debug');
        $this->response = $this->response->withType('csv');
        return $this->response->withFile(
            $temp_csv_file_path,
            [
                'download' => true,
                'name' => 'hoge.csv'
            ]
        );
    }
    public function outputCsv()
    {
        // CSVの出力先（tmp/csv）を作成する
        $base_dir = TMP . 'csv' . DS;
        if (!file_exists($base_dir)) {
            mkdir($base_dir, 0777, true);
        }

        // CSV出力をするテーブルのリストを取得する
        $tables = ConnectionManager::get('default')->getSchemaCollection()
            ->listTables();
        while (($index = array_search("phinxlog", $tables, true)) !== false) {
            // phinxlogはCSVに出力しない
            unset($tables[$index]);
        }

        // テーブルのリスト分データを取得し、CSVファイルに出力する
        foreach ($tables as $table) {
            $data = TableRegistry::get($table)->find()
                ->toArray();
            $fp = fopen("{$base_dir}{$table}.csv", 'w');
            foreach ($data as $key => $row) {
                $output_data = $row->toArray();
                $this->log($output_data, 'debug');
                if ($key === 0) {
                    // 取得したデータのキーからヘッダーを作成する
                    fputcsv($fp, array_keys($output_data));
                }
                fputcsv($fp, $output_data, ",", '"');
            }
            fclose($fp);
        }
    }
}