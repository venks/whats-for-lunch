<?php
/**
 *
 */
namespace AppBundle\Service;

use AppBundle\Exception\IngredientsDatasourceException;

use Symfony\Component\HttpKernel\Config\FileLocator;

use Symfony\Component\Config\Exception\FileLocatorFileNotFoundException;

/**
*
*/
class FridgeService
{
	/**
	 * File locator
	 */
    private $_fileLocator;

   /**
    * Constructor
    *
    * @param $fileLocator FileLocator
    */
   public function __construct(FileLocator $fileLocator)
   {
   		$this->_fileLocator = $fileLocator;
   }

	/**
	 * Get ingredients whose best-before date is after given date
	 *
	 * @param string $date Date in Y-m-d format
	 *
	 * @return array Array of ingredients
	 */
	public function getFreshIngredients($date)
	{
		$allIngredients = $this->getIngredients();
		$ingredients = array();
		foreach ($allIngredients as $ingredient)
		{
			// var_dump($ingredient);die();
			$bestBefore = new \Datetime($ingredient->{'best-before'});
			if ($bestBefore > $date) {
				$ingredients[] = $ingredient;
			}
		}
		return $ingredients;
	}

	/**
	 * Get ingredients whose best-before date is past supplied date but use-by date is after given date
	 *
	 * @param string $date Date in Y-m-d format
	 *
	 * @return array Array of ingredients
	 */
	public function getIngredientsPastBestBefore($date)
	{
		$allIngredients = $this->getIngredients();
		$ingredients = array();
		foreach ($allIngredients as $ingredient)
		{
			$bestBefore = new \Datetime($ingredient->{'best-before'});
			$useBy = new \Datetime($ingredient->{'use-by'});
			if ($bestBefore <= $date && $date < $useBy) {
				$ingredients[] = $ingredient;
			}
		}
		return $ingredients;
	}

	/**
	 * Returns all ingredients
	 *
	 * @throws IngredientsDatasourceException
	 *
	 * @return array An array of StdObjects representing ingredients
	 */
	public function getIngredients()
	{
		try {
			$resourcePath = $this->_fileLocator->locate('@AppBundle/Resources/data/ingredients.json');

		} catch (\InvalidArgumentException $e) {
			throw new IngredientsDatasourceException('JSON Datasource Not Found');

		} catch (FileLocatorNotFoundException $e) {
			throw new IngredientsDatasourceException('JSON Datasource Not Found');
		}

		$ingredients = json_decode(file_get_contents($resourcePath));
		if ($ingredients === null) {
			throw new IngredientsDatasourceException('Invalid JSON in JSON Datasource');
		}
		return $ingredients->ingredients;
	}

}