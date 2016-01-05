<?php

namespace Site\MainBundle\VideoParser;

class VideoParser {

    static $defaultVideo;

    private static function getYoutubeVideo($url) {
        $originalUrl = $url;
        $url = "http://www.youtube.com/oembed?url=" . urlencode($url) . "&format=json";
//        $r = file_get_contents($url);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        $r = curl_exec($ch);
        $video = json_decode($r);

        if (isset($video->title)) {
            $video->html = preg_replace('/height="\d+/', 'height="439', $video->html);
            $video->html = preg_replace('/width=\"\d+/', 'width="720', $video->html);
            $video->html = str_replace("feature=oembed", "feature=oembed&autoplay=1", $video->html);
            if (preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $originalUrl, $match)) {
                $video_id = $match[1];
            }
            $video->url = "http://www.youtube.com/embed/" . $video_id . "?fs=1&autoplay=1";
            return $video;
        } else {
            return false;
        }
    }

    private static function getVimeoVideo($url) {
        $originalUrl = $url;
        $url = "http://vimeo.com/api/oembed.json?url=" . urlencode($url) . "&width=720&height=439";
//        $r = file_get_contents($url);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        $r = curl_exec($ch);
        curl_close($ch);
        $video = json_decode($r);

        if (isset($video->title)) {
            $video->html = preg_replace('/height="\d+/', 'height="439', $video->html);
            $video->html = preg_replace('/width=\"\d+/', 'width="720', $video->html);
            $video->html = str_replace("feature=oembed", "feature=oembed&autoplay=1", $video->html);
//            $video->url = "http://vimeo.com/api/oembed.json?url=" . urlencode($originalUrl) . "&autoplay=1";
            return $video;
        } else {
            return false;
        }
    }

    public static function getVideo($url) {
        $video = array(
            "html" => "<a href=\".htmlspecialchars($url).\">" . $url . "</a>", // Значение по умолчанию, в случае если сервис не определен
            "title" => ""
        );

        self::$defaultVideo = $video;

        if (strpos($url, "youtube.com") !== false) {
            $video = self::getYoutubeVideo($url);
        }

        if (strpos($url, "vimeo.com") !== false) {
            $video = self::getVimeoVideo($url);
        }

        return $video;
    }

}

?>