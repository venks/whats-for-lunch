<?php
/**
 *
 */

namespace AppBundle\Tests\Service;

use AppBundle\Tests\BaseTestCase;

/**
* Unit test for Fridge Service
*
*/
class FridgeServiceTest extends BaseTestCase
{
    /**
    * Handle for Fridge Service
    */
    private $fridgeService;

    /**
    * Unit test setup method
    *
    * @return null
    */
    public function setUp()
    {
        $this->fridgeService = $this->get('fridge_service');
        parent::setup();
    }

    /**
    * Unit test getFreshIngredients()
    *
    * @return null
    */
    public function testGetFreshIngredients()
    {
        $date = new \Datetime('2018-03-01');
        $ingredients = $this->fridgeService->getFreshIngredients($date);
        $this->assertCount(16, $ingredients);

        $date = new \Datetime('2018-03-07');
        $ingredients = $this->fridgeService->getFreshIngredients($date);
        $this->assertCount(15, $ingredients);

        $date = new \Datetime('2018-03-25');
        $ingredients = $this->fridgeService->getFreshIngredients($date);
        $this->assertCount(0, $ingredients);
    }

    /**
    * Unit test getIngredientsPastBestBefore()
    *
    * @return null
    */
    public function testGetIngredientsPastBestBefore()
    {
        $date = new \Datetime('2018-03-06');
        $ingredients = $this->fridgeService->getIngredientsPastBestBefore($date);
        $this->assertCount(1, $ingredients);

        $date = new \Datetime('2018-03-26');
        $ingredients = $this->fridgeService->getIngredientsPastBestBefore($date);
        $this->assertCount(14, $ingredients);

        $date = new \Datetime('2018-03-27');
        $ingredients = $this->fridgeService->getFreshIngredients($date);
        $this->assertCount(0, $ingredients);

    }


}
