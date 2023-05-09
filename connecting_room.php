<?php
require_once 'connection_database.php';
session_start();



class connect_database {
    public $error_message = 'Комната не найдена';
    public $host          = 'localhost:3306';
    public $database      = 'users_data';
    public $user          = 'root';
    public $password      = 'root';
    public $res;
    public $username;
    public $room_number;

    public function connect() {
        $pdo = Database($this->host, $this->database, $this->user, $this->password);

        $this->username    = $_POST['username'];
        $this->room_number = $_POST['room_number'];

        if (true) {
            $this->res = $pdo->query("SELECT*FROM `game_session` WHERE `game_id`='$room_number'");
        } else {
            $_SESSION['message'] = $error_message;
            header('location: connection.php');
        }
    }
}

class game{

    private $counter = 0;
    public  $url     = 'https://en.wikipedia.org/wiki/Special:Random';
    public  $html;
    public  $html_while;
    public  $matches;
    public  $links;
    public  $link;

    public function page_code(){
        // Получить HTML-код страницы
        $this->html = file_get_contents($this->url);
        $this->html = preg_replace("#(https?|ftp)://\S+[^\s.,> )\];'\"!?]#", '<a href="\\0">\\0</a>', $this->html);
        echo "изначальная страницы".$this->html;


        while ($this->counter < 3) {
            $html_while = $this->html;

            // Получить HTML-код страницы
            $this->html_while = file_get_contents($this->html);
            $this->html_while = preg_replace("#(https?|ftp)://\S+[^\s.,> )\];'\"!?]#", '<a href="\\0">\\0</a>', $this->html_while);

            // Найти все ссылки на странице
            preg_match_all('/<a\s+(?:[^>]*?\s+)?href=(["\'])(.*?)\1/', $this->html_while, $this->matches);

            // Создать массив ссылок
            $this->links = $this->matches[2];

            // Оставить только ссылки на другие страницы Википедии
            $this->wikiLinks = array();
            foreach ($this->links as $this->link) {
                if (strpos($this->link, 'wikipedia.org/wiki/') !== false)
                {
                    $this->wikiLinks[] = $this->link;
                }
            }
        }

            // Вывести все найденные ссылки на другие страницы Википедии
            foreach ($this->wikiLinks as $this->link) {
                echo $this->link . '<br>';
            }


            echo $this->html;
            $this->rand_keys = array_rand($this->wikiLinks, 2);
            $this->counter++;

            $this->html = $this->wikiLinks[$this->rand_keys[0]];
    }


}


$callgame    = new connect_database;
$callconnect = new game;

$callgame->connect();
$callconnect->page_code();









//// Случайная страница на Википедии
//$url = 'https://en.wikipedia.org/wiki/Special:Random';
//
//// Выполняем запрос
//$response = file_get_contents($url);
//$res = $response;
//$res = preg_replace("#(https?|ftp)://\S+[^\s.,> )\];'\"!?]#",'<a href="\\0">\\0</a>',$res);
//
//// Получаем заголовок страницы
//preg_match('/<title>(.*?)<\/title>/is', $response, $matches);
//$title = $matches[1];
//
//// Выводим заголовок
//echo $title;
//echo $res;











//// Случайная страница на Википедии
//$url = 'https://en.wikipedia.org/wiki/Special:Random';
//
//// Выполняем запрос
//$response = file_get_contents($url);
//
//// Получаем заголовок страницы
//preg_match('/<title>(.*?)<\/title>/is', $response, $matches);
//$title = $matches[1];
//
//// Выводим заголовок
//echo $title;
//
//// Максимальная глубина
//$max_depth = 10;
//
//// Текущая глубина
//$depth = 0;
//
//// Случайная страница на Википедии
//$url = 'https://en.wikipedia.org/wiki/Special:Random';
//
//// Пока не достигнута максимальная глубина
//while ($depth < $max_depth) {
//
//    // Выполняем запрос
//    $response = file_get_contents($url);
//
//    // Получаем заголовок страницы
//    preg_match('/<title>(.*?)<\/title>/is', $response, $matches);
//    $title = $matches[1];
//
//    // Выводим заголовок и URL страницы
//    echo "$title\n$url\n\n";
//
//    // Извлекаем ссылку на следующую страницу
//    preg_match('/<a href="(.*?)"/is', $response, $matches);
//    $url = 'https://en.wikipedia.org' . $matches[1];
//
//    // Увеличиваем глубину
//    $depth++;
//}



//// Получить HTML-код страницы
//$html = file_get_contents('https://ru.wikipedia.org/wiki/%D0%98%D0%BD%D0%B3%D1%83%D1%88%D0%B5%D1%82%D0%B8%D1%8F');
//
//// Найти все ссылки на странице
//preg_match_all('/<a\s+(?:[^>]*?\s+)?href=(["\'])(.*?)\1/', $html, $matches);
//
//// Создать массив ссылок
//$links = $matches[2];
//
//// Выбрать случайную ссылку
//$randomLink = $links[array_rand($links)];
//
//// Перенаправить пользователя на случайную ссылку
//echo $randomLink;
//exit();













//
//
//$html_while = $html;
//
//// Получить HTML-код страницы
//$html_while = file_get_contents($url);
//$html_while = preg_replace("#(https?|ftp)://\S+[^\s.,> )\];'\"!?]#",'<a href="\\0">\\0</a>',$html_while);
//
//// Найти все ссылки на странице
//preg_match_all('/<a\s+(?:[^>]*?\s+)?href=(["\'])(.*?)\1/', $html_while, $matches);
//
//// Создать массив ссылок
//$links = $matches[2];
//
//// Оставить только ссылки на другие страницы Википедии
//$wikiLinks = array();
//foreach ($links as $link) {
//    if (strpos($link, 'wikipedia.org/wiki/') !== false) {
//        $wikiLinks[] = $link;
//    }
//}
//
//// Вывести все найденные ссылки на другие страницы Википедии
//foreach ($wikiLinks as $link) {
//    echo $link . '<br>';
//}
//
//echo $html;
//$rand_keys = array_rand($wikiLinks, 2);
//$kag++;
//}
//
//
//
//echo $wikiLinks[$rand_keys[0]] . "\n";