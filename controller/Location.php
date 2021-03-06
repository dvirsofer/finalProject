<?php
/**
 * Created by PhpStorm.
 * User: IgorB
 * Date: 12/12/2015
 * Time: 20:26
 */
require_once('./model/LocationModel.php');
class Location {

    private static $model;

    function __construct()
    {

        try
        {
               self::$model = new LocationModel();

        }
        catch(exaption $e)
        {
            echo $e->getMessage();
        }

    }


    public function getGeoLocation($place = '')
    {

        if(isset($place)    &&  !empty($place))
            $l_place = $place;
        else if(isset($_POST['place'])  &&  !empty($_POST['place']))
            $l_place = $_POST['place'];


        $res = self::$model->getGeoLocation($l_place);

        echo json_encode($res);


    }

    public function getDistance($placeArray ='')
    {
        $source =$placeArray[0];
        $destination =$placeArray[1];
        $sourceLatAndLng = self::$model->getGeoLocation($source);
        $destinationLatAndLng = self::$model->getGeoLocation($destination);
        $distance=self::$model->getDistance($sourceLatAndLng['lat'],$sourceLatAndLng['lng'],$destinationLatAndLng['lat'],$destinationLatAndLng['lng']);
        var_dump($distance);

    }

    public function index()
    {
        var_dump('test');exit;
    }
}