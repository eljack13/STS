<?php

namespace app\controllers\security;

use Yii;
use yii\web\Controller;
use donatj\UserAgent\UserAgentParser;

class SecurityController extends Controller
{


    /**
     * 
     * Uses Yii security to store passwords
     * 
     * @param pwdToHash 
     */
    function actionCryptpassword($pwdToHash)
    {
        return Yii::$app->getSecurity()->generatePasswordHash($pwdToHash);
    }

    /**
     * 
     * Using Yii security, validate the password given with the stored hash
     * 
     * @param pwdToValidate Password to be hashed for validation
     * @param pwdHash Hash to compare
     */
    function actionValidatepassword($pwdToValidate, $pwdStored)
    {
        return Yii::$app->getSecurity()->validatePassword($pwdToValidate, $pwdStored);
    }

    /**
     * 
     * Return the logged user id
     */
    function actionGetuserid()
    {
        return Yii::$app->user->identity->tbl_usuarios_id;
    }

    /**
     * 
     * Return the user agent of the user
     */
    function actionGetuseragent()
    {
        return Yii::$app->request->userAgent;
    }

    /**
     * 
     * Return the user remote ip
     */
    function actionGetuserremoteip()
    {
        return Yii::$app->request->remoteIP;
    }


    /**
     * 
     * Return the user ip
     */
    function actionGetuserip()
    {
        return Yii::$app->request->userIP;
    }

    /**
     * 
     * 
     * Use geoplugin.net to determine the contintent of thah IP
     */
    function actionGetiplocation($ip)
    {
        //Get user IP address
        //$ip=$_SERVER['REMOTE_ADDR'];
        //Using the API to get information about this IP
        $details = json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=$ip"));
        //Using the geoplugin to get the continent for this IP
        $continent = $details->geoplugin_continentCode;
        //And for the country
        $country = $details->geoplugin_countryCode;
        //If continent is NA (North America)
        //var_dump($details);
        if ($continent === "NA" && $country === "MX") {
            //Do action if country is MX or not from North america
            return true;
        } else {
            return false;
        }
    }

    /**
     * 
     * Get the actual date
     */
    public function actionGetdate()
    {
        return date('Y-m-d H:m:s');
    }

    public function actionGetcondenseduseragent(){

        $parser = new UserAgentParser();
        $ua = $parser();
        $uaPlatform = $ua->platform() . PHP_EOL;
        $uaBrowser = $ua->browser() . PHP_EOL;
        $uaBrowserVersion = $ua->browserVersion() . PHP_EOL;

        return "$uaBrowser ($uaBrowserVersion) on $uaPlatform";
    }
}
