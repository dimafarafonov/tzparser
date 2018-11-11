<?php
/**
 * Created by PhpStorm.
 * User: Dmitriy
 * Date: 11.11.2018
 * Time: 0:22
 */
require_once "phpquery-master/phpQuery/phpQuery.php";

class Parse
{
    private $array = array(
        'title' => '',
        'img' => '',
        'price' => ''
    );

    public function print_info($arr)
    {
        echo '<pre>' . print_r($arr, true) . '</pre>';
    }

    function __construct($url)
    {

        $file = file_get_contents($url);
        $page = phpQuery::newDocument($file);
        foreach ($page->find('#mainProductContentContainer') as $exp) ;
        {
            $exp = pq($exp);
            $img = $exp->find('.gallery-img img')->attr(src);
            $title = $exp->find('.page-header')->text();
            $price = $exp->find('[itemprop=price]')->attr(content);
        }
        $this->array['title'] = $title;
        $this->array['img'] = $img;
        $this->array['price'] = $price;
        $this->print_info($this->array);
    }

}