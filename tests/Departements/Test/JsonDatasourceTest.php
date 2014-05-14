<?php
namespace Departements\Test;

use Departements\Datasource\JsonDatasource;

/**
 * Generated by PHPUnit_SkeletonGenerator 1.2.1 on 2014-03-04 at 22:57:42.
 */
class JsonDatasourceTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var JsonDatasource
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $file = __DIR__ . '/Resources/datas/datas.json';
        $this->object = new JsonDatasource($file);
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
    }

    /**
     * @covers Departements\Datasource\JsonDatasource::findAllDepartements
     */
    public function testFindAllDepartements()
    {
        $dept1 = $this->object->findAllDepartements()->get('51')->get();

        $this->assertNotNull($dept1);
        $this->assertEquals($dept1->getName(), 'Marne');

        // test all departement sorted by names
        $collection = $this->object->findAllDepartements(true);

        list($code, $firstElement) = $collection->first()->get();
        list($code, $lastElement) = $collection->last()->get();

        $this->assertEquals($firstElement->getName(), 'Aisne');
        $this->assertEquals($lastElement->getName(), 'Somme');

        // test all departement not sorted by names
        $collection = $this->object->findAllDepartements(false);

        list($code, $firstElement) = $collection->first()->get();
        list($code, $lastElement) = $collection->last()->get();

        $this->assertEquals($firstElement->getName(), 'Marne');
        $this->assertEquals($lastElement->getName(), 'Aisne');
    }

    /**
     * @covers Departements\Datasource\JsonDatasource::findAllRegions
     */
    public function testFindAllRegions()
    {
        $region1 = $this->object->findAllRegions()->get('21')->get();

        $this->assertNotNull($region1);
        $this->assertEquals($region1->getName(), 'Champagne-Ardenne');
    }

    /**
     * @covers Departements\Datasource\JsonDatasource::findDepartementByCode
     */
    public function testFindDepartementByCode()
    {
        $dept1 = $this->object->findDepartementByCode('51');

        $this->assertNotNull($dept1);
        $this->assertEquals($dept1->getName(), 'Marne');
    }

    /**
     * @covers Departements\Datasource\JsonDatasource::findDepartementByName
     */
    public function testFindDepartementByName()
    {
        $dept1 = $this->object->findDepartementByName('Marne');

        $this->assertNotNull($dept1);
        $this->assertEquals($dept1->getCode(), '51');
    }

    /**
     * @covers Departements\Datasource\JsonDatasource::findRegionByName
     */
    public function testFindRegionByName()
    {
        $region1 = $this->object->findRegionByName('Champagne-Ardenne');

        $this->assertNotNull($region1);
        $this->assertEquals($region1->getCode(), '21');
    }

    /**
     * @covers Departements\Datasource\JsonDatasource::findRegionByCode
     */
    public function testFindRegionByCode()
    {
        $region1 = $this->object->findRegionByCode('21');

        $this->assertNotNull($region1);
        $this->assertEquals($region1->getName(), 'Champagne-Ardenne');
    }
}
