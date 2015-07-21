<?php
include 'config.php';
include 'parserModule.php'; // Парсинг таблиц
include 'dbModule.php';
include 'mailModule.php';

class Action
{
    private $dbModule;

    public function __construct($act)
    {
        $this->dbModule = new dbModule();
        switch ($act) {
            case 'parse':
                $this->parseAndInsert();
                break;
            case 'sendMail':
                $this->sendMail();
                break;
            default:
                die('no such action');
        }
    }

    public function parseAndInsert()
    {
        $priceUrl = PRICE_URL;
        $parser = new Parser();
        $parsedArray = $parser->parse($priceUrl);
        if ($parsedArray) {
            if ($this->dbModule->insertArray($parsedArray)) {
                echo 'Готово';
            } else {
                echo 'Ошибка';
            }
        } else {
            echo 'Ошибка';
        }
    }

    public function sendMail()
    {
        if (isset($_POST['mail'])){
            $mail=$_POST['mail'];
            $message='';
            $type=$_POST['type'];
            if ($type==1) {
                $message=$this->dbModule->selectTypeOne();
            }
            if ($type==2) {
                $message=$this->dbModule->selectTypeTwo();
            }
            if ($type==3) {
                $dateFrom=$_POST['date3'].'-'.$_POST['date2'].'-'.$_POST['date1'];
                $dateDo=$_POST['date32'].'-'.$_POST['date22'].'-'.$_POST['date12'];
                $message=$this->dbModule->selectTypeThree($dateFrom,$dateDo);
            }

            //Отправка письма на почту
            if (send_mime_mail(FROM_EMAIL,
                FROM_EMAIL,
                'Получатель',
                $mail,
                'UTF-8',"CP1251", // кодировка, в которой будет отправлено письмо
                "Parse Report",
                $message)) {
                echo 'Отчет отправлен:<br>'.$message;
            } else {
                echo 'Отчет не отправлен';
            }
        }
    }

}
if (isset($_POST['act'])){
    $act=$_POST['act'];
    $Action = new Action($act);
}