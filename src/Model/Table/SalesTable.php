<?php

namespace App\Model\Table;

use Cake\Database\Expression\IdentifierExpression;
use Cake\Database\Query;
use Cake\I18n\Date;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use DateTimeInterface;

/**
 * Sales Model.
 *
 * @property \App\Model\Table\CustomersTable&\Cake\ORM\Association\BelongsTo $Customers
 * @property \App\Model\Table\ProductsTable&\Cake\ORM\Association\BelongsTo  $Products
 *
 * @method \App\Model\Entity\Sale       get($primaryKey, $options = [])
 * @method \App\Model\Entity\Sale       newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Sale[]     newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Sale|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Sale       saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Sale       patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Sale[]     patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Sale       findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class SalesTable extends Table
{
    /**
     * Initialize method.
     *
     * @param array $config the configuration for the Table
     *
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('sales');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Customers', [
            'foreignKey' => 'customer_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Products', [
            'foreignKey' => 'product_id',
            'joinType' => 'INNER',
        ]);

        // ビヘイビア（friendsofcake/search）の追加
        $this->addBehavior('Search.Search');

        //検索条件の追加
        $this->searchManager()
            ->callback('start', [
                'callback' => function ($query, $args, $filter) {
                    if (empty($args['end'])) {
                        return;
                    }

                    return $query->where(function ($exp) use ($args) {
                        return $exp->between(
                            'Sales.order_date_at',
                            $args['start'],
                            $args['end']
                        );
                    });
                },
            ])
            ->callback('end', [
                'callback' => function ($query, $args, $filter) {
                },
            ]);
        // ->like('customer_name', ['before' => true, 'after' => true]);
        //->compare('order_date_at', ['operator' => '>=']);
        //->compare('order_to', ['operator' => '<=', 'field' => ['order_date_at']]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator validator instance
     *
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmptyString('id', null, 'create');

        $validator
            ->scalar('customer_name')
            ->maxLength('customer_name', 50)
            ->requirePresence('customer_name', 'create')
            ->notEmptyString('customer_name');

        $validator
            ->scalar('product_name')
            ->maxLength('product_name', 50)
            ->requirePresence('product_name', 'create')
            ->notEmptyString('product_name');

        $validator
            ->integer('product_price')
            ->requirePresence('product_price', 'create')
            ->notEmptyString('product_price');

        $validator
            ->date('order_date_at')
            ->requirePresence('order_date_at', 'create')
            ->notEmptyDate('order_date_at');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules the rules object to be modified
     *
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['customer_id'], 'Customers'));
        $rules->add($rules->existsIn(['product_id'], 'Products'));

        return $rules;
    }

    /**
     * 2つの日付間の月の、月初の日付を入れにして返す。
     *
     * @param date $from
     *@param date $to
     *
     *@return DatetimeInterface[]
     */
    public function getTargetMonths(DateTimeInterface $from, DateTimeInterface $to): array
    {
        $r = [];
        for ($m = $from; $m->format('Y-m-01') <= $to->format('Y-m-01'); $m = $m->modify('+1 month')) {
            $r[] = $m;
        }

        return $r;
    }

    /**
     * クロス集計するカスタムファインダー
     */
    public function findCrossAggregate(Query $query, array $options): Query
    {
        $select = [
        'product_name',
      ];

        $months = $options['months'];
        foreach ($months as $m) {
            $q = $this->find();
            $case = $q->newExpr()->addCase(
          [
            $q->newExpr()->between('Sales.order_date_at', $m->format('Y-m-01'), $m->format('Y-m-t')),
          ],
          [new IdentifierExpression('Sales.product_price'), 0],
          ['integer', 'integer']
        );
            $select[$m->format('Y/m')] = $q->func()->sum($case);
        }

        return $query
        ->select($select)
        ->group('product_name');
    }
}
