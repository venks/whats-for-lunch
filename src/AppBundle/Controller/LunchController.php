<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use FOS\RestBundle\Controller\FOSRestController;

class LunchController extends FOSRestController
{
    /**
     * GET request to /api/v1/lunch
     */
    public function getAction(Request $request)
    {
        $recipeService = $this->get('recipe_service');

        $fridgeService = $this->get('fridge_service');

        $today = new \Datetime();

        $freshIngredients = $fridgeService->getFreshIngredients($today);

        $recipes = $recipeService->getRecipesByIngredients($freshIngredients);

        $pastBestBeforeIngredients = $fridgeService->getIngredientsPastBestBefore($today);

        $recipes = array_merge($recipes, $recipeService->getRecipesByIngredients($pastBestBeforeIngredients));

        //Cast StdObjects to array
        $recipes = json_decode(json_encode($recipes), true);

        $response = array('recipes' => $recipes);

        $view = $this->view($response, Response::HTTP_OK);

        return $this->handleView($view);
    }

}
