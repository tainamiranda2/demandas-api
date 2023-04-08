<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PapelTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PapelTable Test Case
 */
class PapelTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\PapelTable
     */
    public $Papel;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Papel',
        'app.Usuarios',
        'app.Usuario',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Papel') ? [] : ['className' => PapelTable::class];
        $this->Papel = TableRegistry::getTableLocator()->get('Papel', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Papel);

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
}
