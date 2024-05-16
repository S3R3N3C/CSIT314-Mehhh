<?php
include_once("../../Entity/fav.php");

class viewFavListController
{
    public function viewFavList($buyer_id): array
    {
        $vfl = new fav();
        $favList = $vfl->viewFavList($buyer_id);
        return $favList;
    }
}