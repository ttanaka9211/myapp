<?php

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\SalesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use DateTimeInterface;
use Cake\Database\Expression\IdentifierExpression;
use Cake\Database\Query;

/**
 * App\Model\Table\SalesTable Test Case
 */
class SalesTableTest extends TestCase
{
  /**
   * Test subject
   *
   * @var \App\Model\Table\SalesTable
   */
  public $Sales;

  /**
   * Fixtures
   *
   * @var array
   */
  public $fixtures = [
    'app.Sales',
    'app.Customers',
    'app.Products',
  ];

  /**
   * setUp method
   *
   * @return void
   */
  public function setUp()
  {
    parent::setUp();
    $config = TableRegistry::getTableLocator()->exists('Sales') ? [] : ['className' => SalesTable::class];
    $this->Sales = TableRegistry::getTableLocator()->get('Sales', $config);
  }

  /**
   * tearDown method
   *
   * @return void
   */
  public function tearDown()
  {
    unset($this->Sales);

    parent::tearDown();
  }

  /**
   * Test initialize method
   *
   * @return void
   */
  public function testInitialize()
  {
    $this->markTestIncomplete('Not implemented yet.');
  }

  /**
   * Test validationDefault method
   *
   * @return void
   */
  public function testValidationDefault()
  {
    $this->markTestIncomplete('Not implemented yet.');
  }

  /**
   * Test buildRules method
   *
   * @return void
   */
  public function testBuildRules()
  {
    $this->markTestIncomplete('Not implemented yet.');
  }

  /**
   * 2つの日付間の月の、月初の日付を配列にして返す
   *
   * @param DateTimeInterface $from
   * @param DateTimeInterface $to
   */
  public function getTargetMonths(DateTimeInterface $from, DateTimeInterface $to): array
  {
    $r = [];
    for ($m = $from; $m->format('Y-m-01') <= $to->format('Y-m-01'); $m = $m->DateTime::modify("+1 months")) {
      $r[] = $m;
    }
    return $r;
  }

  /**
   * クロス集計するカスタムファインダー
   *
   * @param Query $query
   * @param array $options
   * @return Query
   */
  public function findCrossAggregate(Query $query, array $options): Query
  {
    $select = [
      'Sales.customer_name',
    ];

    /** @var DateTimeInterface[] $months */
    $months = $options['months'];
    foreach ($months as $m) {
      $q = $this->Sales->find();
      $case = $q->newExpr()->addCase(
        [
          $q->newExpr()->between('Sales.order_day_at', $m->format('Y-m-01'), $m->format('Y-m-t')),
        ],
        [new IdentifierExpression('Sales.product_price'), 0],
        ['integer', 'integer']
      );
      $select[$m->format('Y/m')] = $q->func()->sum($case);
    }

    return $query
      ->select($select)
      ->contain(['Sales.order_day_at'])
      ->group(['Customer.names']);
  }
}
