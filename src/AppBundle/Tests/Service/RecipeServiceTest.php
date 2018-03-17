<?php
/**
 *
 */

namespace AppBundle\Tests\Service;

use AppBundle\Tests\BaseTestCase;

/**
* Unit test for Recipe Service
*
*/
class RecipeServiceTest extends BaseTestCase
{
    /**
    * Handle for Recipe Service
    */
    private $recipeService;

    /**
    * Unit test setup method
    *
    * @return null
    */
    public function setUp()
    {
        $this->recipeService = $this->get('recipe_service');
        parent::setup();
    }

    /**
    * Unit test getRecipes()
    *
    * @return null
    */
    public function testGetRecipes()
    {
        $recipes = $this->recipeService->getRecipes();
        $this->assertCount(4, $recipes);
    }
}