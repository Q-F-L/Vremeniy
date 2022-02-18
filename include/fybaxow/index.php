<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
?>
    <style>
        .hit-news-articles {
            margin: 20px auto;
            padding: 15px;
        }

        .hit-news-articles p {
            text-indent: 18px;
        }
    </style>
    <div class="hit-news-articles">
        <?
        define("HIT_NEWS_CATFILE", "catalog.txt");
        define("HIT_NEWS_CATALOG", './news');
        define("HIT_IMAGES_CATALOG", './images');

        $arMessage['back'] = 'Назад';
        $arMessage['articles'] = 'Статьи';
        $arMessage['email'] = 'Email для связи';
        if (strtoupper(LANG_CHARSET) == 'WINDOWS-1251') {
            foreach ($arMessage as $key => $mess) {
                $arMessage[$key] = mb_convert_encoding($arMessage[$key], "windows-1251", "utf-8");
            }
        };

        $arFiles = getFiles();
        $newsId = 0;
        if(!empty($_GET['ID'])) $newsId = intval($_GET['ID']);
        if ($newsId > 0) {
            $body = getNews($newsId);
            $article = $arFiles[$newsId];
            $article['body'] = preg_replace( "/(<!--.*?-->)/s", "", $body );

            $APPLICATION->SetTitle($arFiles[$newsId]['title']);
            $imgSrc = HIT_IMAGES_CATALOG . '/' . $newsId . ".jpg";
            if (file_exists($imgSrc)) {
                if (!empty($article['url'])) {
                    echo '<a href="' . $article["url"] . '" title="' . $article['title'] . '">';
                }
                echo '<img alt="' . $article['title'] . '" src="' . $imgSrc . '" style="max-width: 400px; width:100%;">' . PHP_EOL;
                if (!empty($article['url'])) {
                    echo "</a>";
                }
            }
            echo $article['body'] . PHP_EOL;
            echo "<a href='./'>" . $arMessage['back'] . "</a>" . PHP_EOL;
        } else {
           $APPLICATION->SetTitle($arMessage['articles']);
            foreach ($arFiles as $fid => $article) {
                ?>
                <li>
                    <a href="?ID=<?= $fid ?>"><?= $article['title'] ?></a>
                    <p><?= $article['description'] ?></p>
                </li>
                <?
            }
            echo "</ul>" . PHP_EOL;
        }

        function getNews($id)
        {
            $body = file_get_contents(HIT_NEWS_CATALOG . "/" . $id . ".html");
            if (strtoupper(LANG_CHARSET) == 'WINDOWS-1251') {
                $body = mb_convert_encoding($body, "windows-1251", "utf-8");
            }
            return $body;
        }

        function getFiles()
        {
            global $catFile, $dir;
            $catFile = HIT_NEWS_CATFILE;
            $dir = HIT_NEWS_CATALOG;

            $arFiles = [];
            if (file_exists($catFile) && (time() - filemtime($catFile) < 60 * 60 * 24)) {
                $arFiles = unserialize(file_get_contents($catFile));
            } else {
                if ($handle = opendir($dir)) {
                    while (false !== ($file = readdir($handle))) {
                        if ($file != "." && $file != "..") {
                            $idx = preg_split("!\.!", $file)[0];
                            $arFiles[$idx]["id"] = $idx;
                            $arFiles[$idx]["file"] = $file;
                            $body = file_get_contents($dir . '/' . $file);
                            if (preg_match_all("/<!--(.*?)-->/", $body, $match)) {
                                foreach ($match[1] as $item) {
                                    $arr = preg_split("!\|!", $item);
                                    $arFiles[$idx][$arr[0]] = $arr[1];
                                }
                            }
                        }
                    }
                    closedir($handle);
                    ksort($arFiles);
                }
            }
            if (strtoupper(LANG_CHARSET) == 'WINDOWS-1251') {
                foreach ($arFiles as $idx => $file) {
                    foreach ($file as $key => $value) {
                        $arFiles[$idx][$key] = mb_convert_encoding($value, "windows-1251", "utf-8");
                    }
                }
            }
            return ($arFiles);
        }

        ?>
        <br><br><br>
        <?=$arMessage['email']?>: <a href="mailto:blackPoster404@ya.ru">blackPoster404@ya.ru</a>
    </div>
<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php");