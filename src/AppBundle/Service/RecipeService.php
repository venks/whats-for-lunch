<?php
/**
 *
 */
namespace AppBundle\Service;

use AppBundle\Service\RecipeDatasourceInterface;

/**
* Recipe Service
*/
class RecipeService
{
	/**
	 * Recipe Data Source
	 */
	protected $recipeData;

	/**
	 * Constructor
	 *
	 * @param RecipeDatasourceInterface Any recipe data source that implements RecipeDatasourceInterface
	 */
	public function __construct(RecipeDatasourceInterface $recipeData)
	{
		$this->recipeData = $recipeData;
	}

	/**
	 *
	 */
	public function getRecipes()
	{
		return $this->recipeData->getRecipes();
	}


	/**
	 * Returns recipes by ingredients
	 *
	 * @param array $ingredients Array of ingredient StdObjects
	 *
	 * @return array Array of recipes
	 */
	public function getRecipesByIngredients(array $ingredients)
	{
		$recipes = array();
		$allRecipes = $this->getRecipes();
		foreach ($allRecipes as $recipe)
		{
			$recipeIngredients = $recipe->ingredients;
			$allIngredientsAvailable = true;
			foreach ($recipeIngredients as $recipeIngredient)
			{
				if ($this->ingredientAvailable($recipeIngredient, $ingredients) === false) {
					$allIngredientsAvailable = false;
					break;
				}
			}

			if ($allIngredientsAvailable === true) {
				$recipes[] = $recipe;
			}
		}
		return $recipes;
	}


	/**
	 * Check if a specific ingredient is available in list of ingredients
	 *
	 * @param string $recipeIngredient Ingredient to be looked up
	 * @param array  $ingredients List of ingredients to be searched
	 *
	 * @return boolean True if ingredient is found, false otherwise.
	 */
	public function ingredientAvailable($recipeIngredient, array $ingredients)
	{
		foreach ($ingredients as $ingredient)
		{
			if ($ingredient->title === $recipeIngredient) {
				return true;
			}
		}
		return false;
	}

}