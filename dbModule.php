<?php
class dbModule
{
    private $link;

    public function __construct()
    {
        $this->connect();
    }

    public function connect()
    {
        /* Подключение к серверу MySQL */
        $this->link = mysqli_connect(
            DB_HOST,  /* Хост, к которому мы подключаемся */
            DB_USER,       /* Имя пользователя */
            DB_PASS,           /* Используемый пароль  */
            DB_DATABASE);     /* База данных для запросов по умолчанию */

        if (!$this->link) {
            echo 'Невозможно подключиться к базе данных. Код ошибки: ' . mysqli_connect_error();
            return false;
        } else {
            $this->link->set_charset('utf8');
            return true;
        }
    }

    public function insertArray($array)
    {
        //Добавление в базу
        $result = '';
        if ($this->link) {
            foreach ($array as $key => $value) {
                if (!empty($array[$key]['name']) && !empty($array[$key]['price'])) {
                    $name = mysql_real_escape_string($array[$key]['name']);
                    $price = mysql_real_escape_string($array[$key]['price']);
                    $result = mysqli_query($this->link, "INSERT INTO parse.entries (id, name, price) VALUES (NULL,'$name','$price')");
                    mysql_error();
                }
            }
        }
        return $result;
    }

    public function selectTypeOne()
    {
        //Записи за 3 часа
        if ($this->link) {
            $result = mysqli_query($this->link, "SELECT * FROM `entries` WHERE  entries.date > now() - Interval 3 HOUR;");
            mysql_error();
            if ($result) {
                $count = 0;
                while ($row = mysqli_fetch_assoc($result)) {
                    $count = $count + 1;
                }
                $message = 'Записей за 3 часа - ' . $count;
                return $message;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function selectTypeTwo()
    {
        //Средняя цена за 24 часа
        $result = mysqli_query($this->link, "SELECT AVG(price) FROM `entries` WHERE entries.date > now() - Interval 24 HOUR");
        mysql_error();
        if ($result) {
            $row = mysqli_fetch_array($result);
            $message = 'Средняя цена за 24 часа - ' . $row[0];
            return $message;
        } else {
            return false;
        }
    }

    public function selectTypeThree($dateFrom,$dateDo)
    {
        //Диапозон Дат
        if ($this->link) {
            $dateFrom=mysql_real_escape_string($dateFrom);
            $dateDo=mysql_real_escape_string($dateDo);
            $result = mysqli_query($this->link, "SELECT * FROM `entries` WHERE entries.date >='" . $dateFrom . "' AND entries.date <= '" . $dateDo . "' ORDER BY price ASC LIMIT 3;");
            mysql_error();
            if ($result) {
                $message='3 значения с минимальной ценой в промежуток времени с '.$dateFrom.' по '. $dateDo.'<br>';
                while ($row = mysqli_fetch_assoc($result)) {
                    $message .= $row['name'] . ', Цена - ' . $row['price'] .' , Дата - '.$row['date'].'<br>';
                }
                return $message;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
}
