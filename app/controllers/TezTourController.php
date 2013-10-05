<?php

class TezTourController extends JsonController {
    
    public $success = false;
    
    public function getIndex()
    {      
        $this->result = 'goforet';
        
        $this->hope = 55566;
        
        return $this->postSearch();
    }
    
    
    public function getSearch()
    {
        $data = array(
            'countryId'        => '', //=1104 – id страны отдыха;
            'cityId'           => '', //=345 – id города вылета;
            'priceMin'         => '', //=0 – минимальная стоимость отдыха;
            'priceMax'         => '', //=999999 – максимальная стоимость отдыха;
            'before'           => '', //=31.05.2010 – верхняя планка диапазона даты заезда;
            'after'            => '', //=21.05.2010 – нижняя планка диапазона даты заезда. Максимально допустимый диапазон между датами заезда - 60 дней;
            'currency'         => '', //=5561 – id валюты, в которой указана цена;
            'nightsMin'        => '', //=7 – минимальное количество ночей, проведенных в отеле;
            'nightsMax'        => '', //=15 – максимальное количество ночей, проведенных в отеле. Максимально допустимый диапазон - 8 ночей;
            'accommodationId'  => '', //=2 – id размещения;
            'hotelClassId'     => '', //=2569 – id уровня отеля(звездность);
            'hotelClassBetter' => '', //=true / false – позволяет(либо не позволяет) выдавать в результате подбора отели классом выше указанного(в интерфейсе выглядит как флажок «и лучше»);
            'rAndBId'          => '', //=2424 – id пансиона;
            'rAndBBetter'      => '', //=true / false – позволяет(либо не позволяет) выдавать в результате подбора предложения с пансионом уровнем выше указанного(в интерфейсе выглядит как флажок «и лучше»);
            'noTicketsFrom'    => '', //=false / true – позволяет(либо не позволяет) искать предложения для которых нет подходящих вылетов обратно(в интерфейсе выглядит как флажок «нет билетов обратно»);
            'noTicketsTo'      => '', //=false / true – позволяет(либо не позволяет) искать предложения для которых нет подходящих вылетов туда(в интерфейсе выглядит как флажок «нет билетов туда»);
            'hotelInStop'      => '', //=false / true – позволяет(либо не позволяет) искать предложения для которых отели в стопе(в интерфейсе выглядит как флажок «отели в стопе»);
            'spoRegionId'      => '', //=1234 – id региона СПО. Для каждой страны регион СПО несет свою смысловую нагрузку(в интерфейсе выглядит как список «Тур»). Не может быть использован вместе с tourId.
            'tourId'           => '', //=1285 – id региона. Можно указать несколько регионов: tourId=14259&tourId=14385. Для двойного проживания значения необходимо указывать через запятую: tourId=14259,14385. Параметр не может быть использован вместе с spoRegionId.
            'hotelId'          => '', //=1234 – id отеля. Можно указать несколько отелей: hotelId=1234&hotelId=12345;
            'birthday1'        => '', //=22.06.2005 – день рождения ребенка. Параметр должен указываться только в случае размещения ребенка;
            'birthday2'        => '', //=12.06.2005 – день рождения второго ребенка. Параметр должен быть указан только в случае размещения двух детей.
        );
        
        $url = 'http://search.tez-tour.com/toursearch/getResult?accommodationId=2&after=21.11.2013&before=30.11.2013&cityId=345&countryId=1104&currency=8390&hotelClassBetter=true&hotelClassId=2569&hotelInStop=false&locale=ru&nightsMax=15&nightsMin=7&noTicketsFrom=false&noTicketsTo=false&priceMax=999999&priceMin=0&rAndBBetter=true&rAndBId=2424&tourId=1285&formatResult=true&xml=true';
        
        
        $sxml = new SimpleXMLElement(file_get_contents($url));
        //header('Content-Type: text/plain; charset=utf-8');
        //print_r($sxml);
        
        $success = (bool) $sxml->success;
        
        if (isset($sxml->success) AND $success === true) {
            
            $this->success = true;
            
            $data = array_values( (array) $sxml->data );
            
            if (is_array($data) AND count($data) == 1) {
                $this->result = $data[0];
            }
            else {
                $this->result = $data;
            }
        }
        
        //$this->result = (string) $sxml->success;
    }

}
