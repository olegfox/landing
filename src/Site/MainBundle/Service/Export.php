<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 12.01.16
 * Time: 7:03
 */

namespace Site\MainBundle\Service;

class Export
{

    /**
     * Копирование директории с содержимым
     *
     * @param String $src - Директория из которой копируем
     * @param String $dest - Директория в которую копируем
     */
    public static function rcopy($src, $dest)
    {
        if (!is_dir($src)) return false;

        if (!is_dir($dest)) {
            if (!mkdir($dest, 0777, true)) {
                return false;
            }
        }

        $i = new \DirectoryIterator($src);
        foreach ($i as $f) {
            if ($f->isFile()) {
                copy($f->getRealPath(), "$dest/" . $f->getFilename());
            } else if (!$f->isDot() && $f->isDir()) {
                self::rcopy($f->getRealPath(), "$dest/$f");
            }
        }
    }

    /**
     * Удаление директории
     *
     * @param $dir
     */
    public static function rrmdir($dir)
    {
        if (is_dir($dir)) {
            $objects = scandir($dir);
            foreach ($objects as $object) {
                if ($object != "." && $object != "..") {
                    if (is_dir($dir . "/" . $object))
                        self::rrmdir($dir . "/" . $object);
                    else
                        unlink($dir . "/" . $object);
                }
            }
            rmdir($dir);
        }
    }

    /**
     * Создание Zip архива
     *
     * @param $source
     * @param $destination
     * @return bool
     */
    public static function zip($source, $destination)
    {
        if (!extension_loaded('zip') || !file_exists($source)) {
            return false;
        }

        $zip = new \ZipArchive();
        if (!$zip->open($destination, \ZipArchive::CREATE)) {
            return false;
        }

        $source = str_replace('\\', '/', realpath($source));

        if (is_dir($source) === true) {
            $files = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($source), \RecursiveIteratorIterator::SELF_FIRST);

            foreach ($files as $file) {
                $file = str_replace('\\', '/', $file);

                if (in_array(substr($file, strrpos($file, '/') + 1), array('.', '..')))
                    continue;

                $file = realpath($file);

                if (is_dir($file) === true) {
                    $zip->addEmptyDir(str_replace($source . '/', '', $file . '/'));
                } else if (is_file($file) === true) {
                    $zip->addFromString(str_replace($source . '/', '', $file), file_get_contents($file));
                }
            }
        } else if (is_file($source) === true) {
            $zip->addFromString(basename($source), file_get_contents($source));
        }

        return $zip->close();
    }

}