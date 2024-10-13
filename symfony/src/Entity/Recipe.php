<?php

namespace App\Entity;

use App\Repository\RecipeRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RecipeRepository::class)]
class Recipe
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $recipe_name = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $recipe_description = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRecipeName(): ?string
    {
        return $this->recipe_name;
    }

    public function setRecipeName(string $recipe_name): static
    {
        $this->recipe_name = $recipe_name;

        return $this;
    }

    public function getRecipeDescription(): ?string
    {
        return $this->recipe_description;
    }

    public function setRecipeDescription(string $recipe_description): static
    {
        $this->recipe_description = $recipe_description;

        return $this;
    }
}
