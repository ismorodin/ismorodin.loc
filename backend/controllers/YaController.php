<?php

namespace backend\controllers;

use Yii;

/**
 * Yacontroller need for translate
 *
 * @author Иван Смородин
 *
 */
class YaController extends BackendController {

    protected $key = 'cw.1.1.20140309T112227Z.04ecc4233dc9e35a.38404c72f76ce2de43bf2d87ac7f0a4120ef34b3';

    /**
     * display form for translate
     *
     * @category translate
     */
    public function actionGet() {
        return $this->renderPartial('index');
    }

    public function actionCheck() {
        $api_key = $this->key;
        $url_api = 'http://cleanweb-api.yandex.ru/1.0/';
        $user_message = 'Привет<a href="http://ya.ru">Спам</a>>';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//Подготавливаем запрос на проверку спама
        echo "Запрос на проверку спама...\n";
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_URL, $url_api . 'check-spam');
        curl_setopt($ch, CURLOPT_POSTFIELDS, 'key=' . urlencode($api_key) . '&body-plain=' . urlencode($user_message));
        $response = new \SimpleXMLElement(curl_exec($ch));
        echo "Ответ:\n  spam-flag -> ", $response->text['spam-flag'], "\n  request_id -> $response->id\n\n";
        $request_id = $response->id;
        if ($response->text['spam-flag'] == 'yes') {
//Получаем CAPTCHA
            curl_setopt($ch, CURLOPT_HTTPGET, true);
            curl_setopt($ch, CURLOPT_URL, $url_api . 'get-captcha?' . 'key=' . urlencode($api_key) . '&id=' . urlencode($request_id));
            echo "Запрос CAPTCHA...\n";
            $response = new \SimpleXMLElement(curl_exec($ch));
            echo "Ответ:\n  CAPTCHA id -> $response->captcha\n  CAPTCHA url -> $response->url\n";
        }
        curl_close($ch);
    }

}
