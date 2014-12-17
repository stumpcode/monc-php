<?php


class MFile {

    public static function listDirFile($dir, $ext = '', $ignore = array ('.svn', '.git')) {

        $ignore = array_merge(array ('.', '..'), $ignore);
        $handle = opendir($dir);

        $list = array ();
        while ($file = readdir($handle)) {
            if (in_array($file, $ignore)) {
                continue;
            }
            if (is_dir($file)) {
                continue;
            }
            if (is_link($file)) {
                continue;
            }
            if (!empty($ext) && $ext != self::fileExt($file)) {
                continue;
            }
            $list[] = $file;

        }
        return $list;
    }

    public static function fileExt($filePath) {
        if (false === ($pos = strrpos($filePath, '.'))) {
            return;
        }

        return substr($filePath, $pos + 1);
    }
}
