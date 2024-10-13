<?php

namespace App\Controller;

use App\Entity\Recipe;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use \Exception;


class RecipeController extends AbstractController
{
    #[Route('/recipe', name: 'get_recipe', methods:['GET'])]
    public function getRecipe(
        EntityManagerInterface $entityManager,
        ): JsonResponse
    {
        $entities = $entityManager->getRepository(Recipe::class)->findAll();
        $data = array_map(function(Recipe $recipe) {
            return [
                'id' => $recipe->getId(),
                'name' => $recipe->getRecipeName(),
                'description' => $recipe->getRecipeDescription(),
            ];
        }, $entities);
        return new JsonResponse($data, 200, [], false);;
    }

    #[Route('/recipe', name: 'create_recipe', methods:['POST'])]
    public function createRecipe(
        EntityManagerInterface $entityManager,
        Request $request
        ): JsonResponse
    {
        $recipe = json_decode($request->getContent(), true);
        if (!array_key_exists('name', $recipe) || !array_key_exists('description', $recipe)) {
            throw new Exception("Error Processing Request");
        }
        $recipeEntity = new Recipe();
        $recipeEntity->setRecipeName($recipe['name']);
        $recipeEntity->setRecipeDescription($recipe['description']);
        $entityManager->persist($recipeEntity);
        $entityManager->flush();

        return $this->json(
            [
                'id' => $recipeEntity->getId(),
                'name' => $recipeEntity->getRecipeName(),
                'description' => $recipeEntity->getRecipeDescription(),
            ]
        );
    }
}
