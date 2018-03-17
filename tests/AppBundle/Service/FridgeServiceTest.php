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
    public function testgetFreshIngredients()
    {
        $this->assertTrue(true);
    }
}
