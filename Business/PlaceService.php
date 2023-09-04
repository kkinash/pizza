<?php
//Busines/PlaceService.php
declare(strict_types=1);

namespace Business;

use Data\PlaceDAO;
use Entities\Place;
use Exceptions\PlaceNotFoundException;

class PlaceService
{
    private PlaceDAO $placeDAO;
    public function __construct()
    {
        $this->placeDAO = new PlaceDAO();
    }
    public function getAllplacesOverview(): array
    {
        $placeDAO = new PlaceDAO();
        $placesListOverview = $placeDAO->getAllPlaces();

        return $placesListOverview;
    }

    public function addPlaceOverview(int $postcode, string $name, int $isaccessible): int
    {
        $placeDAO = new PlaceDAO();
        $placeid = $placeDAO->addPlace($postcode, $name, $isaccessible);

        return $placeid;
    }


    public function getPlacebyPostcodeOverview(int $postcode): Place
    {
        $placeDAO = new PlaceDAO();
        $place = $placeDAO->getPlacebyPostcode($postcode);

        return $place;
    }

    public function getPlacebyIdOverview(int $id): Place
    {
        $placeDAO = new PlaceDAO();
        $place = $placeDAO->getPlacebyId($id);

        return $place;
    }

    public function getDeliveriblePostcodesOverview(): array
    {
        $placeDAO = new PlaceDAO();
        $placeList = $placeDAO->getDeliveriblePostcodes();
        return $placeList;
    }

    public function editPlaceinOrderbyPostcodeOverview($cityname, $postcode): int
    {
        $placeDAO = new PlaceDAO();
        $id = $placeDAO->editPlaceinOrderbyPostcode($cityname, $postcode);
        return $id;
    }
}