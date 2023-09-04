<?php
//Busines/PizzaService.php
declare(strict_types=1);

namespace Business;

use Data\PizzaDAO;
use Entities\Pizza;


class PizzaService
{
    private PizzaDAO $pizzaDAO;
    public function __construct()
    {
        $this->pizzaDAO = new PizzaDAO();
    }
    public function getAllPizzasOverview(): array
    {
        $pizzaDAO = new PizzaDAO();
        $pizzaListOverview = $pizzaDAO->getAllPizzas();

        return $pizzaListOverview;
    }

    public function getPizzaByIdOverview(int $id): Pizza
    {

        $pizzaDAO = new PizzaDAO();
        $pizzaOverview = $pizzaDAO->getPizzaById((int) $id);

        return $pizzaOverview;


    }
}