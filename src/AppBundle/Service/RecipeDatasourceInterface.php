<?php
/**
 *
 */
namespace AppBundle\Service;

use AppBundle\Exception\RecipeDatasourceException;

/**
 * Recipe DataSource Interface - Any data source that returns recipes must implement this interface
 */
interface RecipeDatasourceInterface
{

	/**
	 *
	 */
	public function getRecipes();


}
