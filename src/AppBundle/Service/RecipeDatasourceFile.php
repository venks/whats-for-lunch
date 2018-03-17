<?php
/**
 *
 */
namespace AppBundle\Service;

use AppBundle\Exception\RecipeDatasourceException;

use Symfony\Component\HttpKernel\Config\FileLocator;

use Symfony\Component\Config\Exception\FileLocatorFileNotFoundException;

/**
 * JSON File DataSource
 */
class RecipeDatasourceFile implements RecipeDatasourceInterface
{

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
	 * Returns all recipes
	 *
	 * @throws RecipeDatasourceNotFoundException
	 *
	 * @return array An array of StdObjects representing recipes
	 */
	public function getRecipes()
	{
		try {
			$resourcePath = $this->_fileLocator->locate('@AppBundle/Resources/data/recipes.json');

		} catch (\InvalidArgumentException $e) {
			throw new RecipeDatasourceException('JSON Datasource Not Found');

		} catch (FileLocatorNotFoundException $e) {
			throw new RecipeDatasourceException('JSON Datasource Not Found');
		}

		$recipes = json_decode(file_get_contents($resourcePath));
		if ($recipes === null) {
			throw new RecipeDatasourceException('Invalid JSON in JSON Datasource');
		}
		return $recipes->recipes;
	}

}
