<?php
class Parser
{
    private $parsedArray=array();

    public function parse($url)
    {
        $html =  file_get_contents($url); // Получение html
        if ($html){
            $dom = new domDocument;
            $dom->loadHTML($html); // загружаем HTML в объект
            $dom->preserveWhiteSpace = false;
            $tables = $dom->getElementsByTagName('table'); // элемент по тегу
            $rows = $tables->item(0)->getElementsByTagName('tr'); // получаем все строки таблицы
            $i=0;
            // цикл по строкам
            foreach ($rows as $row)
            {
                $cols = $row->getElementsByTagName('td');
                if ($cols->length!=0) {
                    $i++;
                    $this->parsedArray[$i]['name']=$cols->item(0)->nodeValue;
                    $this->parsedArray[$i]['price']=intval($cols->item(1)->nodeValue);
                }
            }
            return $this->parsedArray;
        } else {
            return false;
        }

    }

}
