<?php

require_once 'vendor/autoload.php';

class News
{
	function __construct() 
    {

	}

    public static function getFeed()
    {

        $db = new PDO("mysql:host=localhost;dbname=news;charset=utf8", "root", "");
                            
        $sql = "INSERT IGNORE INTO feed (title, link, description, source, pub_date) VALUES (?, ?, ?, ?, ?)";
        $stmt = $db->prepare($sql);

        $feed = new SimplePie();
        $feed->enable_cache(false);

        $feed->set_feed_url('https://rss.unian.net/site/news_ukr.rss');
        $feed->init();

        $items = $feed->get_items();

        foreach ($items as $item) {
            // if (!$db = $db->query('SELECT id FROM news WHERE link = '.$item->get_link()->fetch())) {
            $stmt->execute([
                $item->get_title(),
                $item->get_link(),
                $item->get_description(),
                $feed->get_link(),
                $item->get_date("Y-m-d H:i:s"),
            ]);            
            // }
        }
    }

    public static function getListOfNews() 
    {
        $db = new PDO("mysql:host=localhost;dbname=news;charset=utf8", "root", "");
        $newsList = array();

        $sql = 'SELECT * FROM feed ORDER BY pub_date DESC LIMIT 50';
        $stmt = $db->prepare($sql);

        $stmt->execute();

        $i = 0;
        while ($row = $stmt->fetch()) {
            $newsList[$i]['title'] = $row['title'];
            $newsList[$i]['link'] = $row['link'];
            $newsList[$i]['source'] = $row['source'];
            $newsList[$i]['description'] = $row['description'];
            $newsList[$i]['pub_date'] = $row['pub_date'];
            $i++;
        }
        return $newsList;
    }
}

$model = new News();
$data = array();
$data = $model->getListOfNews();