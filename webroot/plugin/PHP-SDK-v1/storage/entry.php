<?php

class Alibaba_Storage_Entry
{
    private $mime_types = array (
            'apk' => 'application/vnd.android.package-archive',
            '3gp' => 'video/3gpp', 'ai' => 'application/postscript',
            'aif' => 'audio/x-aiff', 'aifc' => 'audio/x-aiff',
            'aiff' => 'audio/x-aiff', 'asc' => 'text/plain',
            'atom' => 'application/atom+xml', 'au' => 'audio/basic',
            'avi' => 'video/x-msvideo', 'bcpio' => 'application/x-bcpio',
            'bin' => 'application/octet-stream', 'bmp' => 'image/bmp',
            'cdf' => 'application/x-netcdf', 'cgm' => 'image/cgm',
            'class' => 'application/octet-stream',
            'cpio' => 'application/x-cpio',
            'cpt' => 'application/mac-compactpro',
            'csh' => 'application/x-csh', 'css' => 'text/css',
            'dcr' => 'application/x-director', 'dif' => 'video/x-dv',
            'dir' => 'application/x-director', 'djv' => 'image/vnd.djvu',
            'djvu' => 'image/vnd.djvu',
            'dll' => 'application/octet-stream',
            'dmg' => 'application/octet-stream',
            'dms' => 'application/octet-stream',
            'doc' => 'application/msword', 'dtd' => 'application/xml-dtd',
            'dv' => 'video/x-dv', 'dvi' => 'application/x-dvi',
            'dxr' => 'application/x-director',
            'eps' => 'application/postscript', 'etx' => 'text/x-setext',
            'exe' => 'application/octet-stream',
            'ez' => 'application/andrew-inset', 'flv' => 'video/x-flv',
            'gif' => 'image/gif', 'gram' => 'application/srgs',
            'grxml' => 'application/srgs+xml',
            'gtar' => 'application/x-gtar', 'gz' => 'application/x-gzip',
            'hdf' => 'application/x-hdf',
            'hqx' => 'application/mac-binhex40', 'htm' => 'text/html',
            'html' => 'text/html', 'ice' => 'x-conference/x-cooltalk',
            'ico' => 'image/x-icon', 'ics' => 'text/calendar',
            'ief' => 'image/ief', 'ifb' => 'text/calendar',
            'iges' => 'model/iges', 'igs' => 'model/iges',
            'jnlp' => 'application/x-java-jnlp-file', 'jp2' => 'image/jp2',
            'jpe' => 'image/jpeg', 'jpeg' => 'image/jpeg',
            'jpg' => 'image/jpeg', 'js' => 'application/x-javascript',
            'kar' => 'audio/midi', 'latex' => 'application/x-latex',
            'lha' => 'application/octet-stream',
            'lzh' => 'application/octet-stream',
            'm3u' => 'audio/x-mpegurl', 'm4a' => 'audio/mp4a-latm',
            'm4p' => 'audio/mp4a-latm', 'm4u' => 'video/vnd.mpegurl',
            'm4v' => 'video/x-m4v', 'mac' => 'image/x-macpaint',
            'man' => 'application/x-troff-man',
            'mathml' => 'application/mathml+xml',
            'me' => 'application/x-troff-me', 'mesh' => 'model/mesh',
            'mid' => 'audio/midi', 'midi' => 'audio/midi',
            'mif' => 'application/vnd.mif', 'mov' => 'video/quicktime',
            'movie' => 'video/x-sgi-movie', 'mp2' => 'audio/mpeg',
            'mp3' => 'audio/mpeg', 'mp4' => 'video/mp4',
            'mpe' => 'video/mpeg', 'mpeg' => 'video/mpeg',
            'mpg' => 'video/mpeg', 'mpga' => 'audio/mpeg',
            'ms' => 'application/x-troff-ms', 'msh' => 'model/mesh',
            'mxu' => 'video/vnd.mpegurl', 'nc' => 'application/x-netcdf',
            'oda' => 'application/oda', 'ogg' => 'application/ogg',
            'ogv' => 'video/ogv', 'pbm' => 'image/x-portable-bitmap',
            'pct' => 'image/pict', 'pdb' => 'chemical/x-pdb',
            'pdf' => 'application/pdf',
            'pgm' => 'image/x-portable-graymap',
            'pgn' => 'application/x-chess-pgn', 'pic' => 'image/pict',
            'pict' => 'image/pict', 'png' => 'image/png',
            'pnm' => 'image/x-portable-anymap',
            'pnt' => 'image/x-macpaint', 'pntg' => 'image/x-macpaint',
            'ppm' => 'image/x-portable-pixmap',
            'ppt' => 'application/vnd.ms-powerpoint',
            'ps' => 'application/postscript', 'qt' => 'video/quicktime',
            'qti' => 'image/x-quicktime', 'qtif' => 'image/x-quicktime',
            'ra' => 'audio/x-pn-realaudio',
            'ram' => 'audio/x-pn-realaudio', 'ras' => 'image/x-cmu-raster',
            'rdf' => 'application/rdf+xml', 'rgb' => 'image/x-rgb',
            'rm' => 'application/vnd.rn-realmedia',
            'roff' => 'application/x-troff', 'rtf' => 'text/rtf',
            'rtx' => 'text/richtext', 'sgm' => 'text/sgml',
            'sgml' => 'text/sgml', 'sh' => 'application/x-sh',
            'shar' => 'application/x-shar', 'silo' => 'model/mesh',
            'sit' => 'application/x-stuffit',
            'skd' => 'application/x-koan', 'skm' => 'application/x-koan',
            'skp' => 'application/x-koan', 'skt' => 'application/x-koan',
            'smi' => 'application/smil', 'smil' => 'application/smil',
            'snd' => 'audio/basic', 'so' => 'application/octet-stream',
            'spl' => 'application/x-futuresplash',
            'src' => 'application/x-wais-source',
            'sv4cpio' => 'application/x-sv4cpio',
            'sv4crc' => 'application/x-sv4crc', 'svg' => 'image/svg+xml',
            'swf' => 'application/x-shockwave-flash',
            't' => 'application/x-troff', 'tar' => 'application/x-tar',
            'tcl' => 'application/x-tcl', 'tex' => 'application/x-tex',
            'texi' => 'application/x-texinfo',
            'texinfo' => 'application/x-texinfo', 'tif' => 'image/tiff',
            'tiff' => 'image/tiff', 'tr' => 'application/x-troff',
            'tsv' => 'text/tab-separated-values', 'txt' => 'text/plain',
            'ustar' => 'application/x-ustar',
            'vcd' => 'application/x-cdlink', 'vrml' => 'model/vrml',
            'vxml' => 'application/voicexml+xml', 'wav' => 'audio/x-wav',
            'wbmp' => 'image/vnd.wap.wbmp',
            'wbxml' => 'application/vnd.wap.wbxml', 'webm' => 'video/webm',
            'wml' => 'text/vnd.wap.wml',
            'wmlc' => 'application/vnd.wap.wmlc',
            'wmls' => 'text/vnd.wap.wmlscript',
            'wmlsc' => 'application/vnd.wap.wmlscriptc',
            'wmv' => 'video/x-ms-wmv', 'wrl' => 'model/vrml',
            'xbm' => 'image/x-xbitmap', 'xht' => 'application/xhtml+xml',
            'xhtml' => 'application/xhtml+xml',
            'xls' => 'application/vnd.ms-excel',
            'xml' => 'application/xml', 'xpm' => 'image/x-xpixmap',
            'xsl' => 'application/xml', 'xslt' => 'application/xslt+xml',
            'xul' => 'application/vnd.mozilla.xul+xml',
            'xwd' => 'image/x-xwindowdump', 'xyz' => 'chemical/x-xyz',
            'zip' => 'application/zip' );

    private $path;
    public function __construct() 
    {
        $this->path = ALISDK_PATH . DIRECTORY_SEPARATOR . 
            "tmp". DIRECTORY_SEPARATOR . "storage" . DIRECTORY_SEPARATOR;
    }

    public function prepare($params = null)
    {
        $config = isset($params[0]) ? $params[0] : '';
        if (is_array($config)) {
            if (!isset($config['id']) || !isset($config['key']) || !isset($config['bucket']))
                $this->except('oss自定义配置信息不全，请传入 id, key, bucket.');
            $config = $config['id'] . $config['key'] . $config['bucket'];
        }
        $path = $this->path . $config;
        if(!is_dir($path)) $this->make_dir($path . 'foo');
        $this->path = $path;
        return $this;
    }

    public function listObject($prefix = null, $maxkeys = 100)
    {
        if($prefix) {
            $this->chkeck_path($prefix);
            if($prefix{strlen($prefix) - 1} != DIRECTORY_SEPARATOR)
                $this->except('prefix 路径非法.');
        }
        $dirs = $this->read_dir($this->path . $prefix);
        $objs = array();
        foreach($dirs as $obj) {
            $path = $prefix . $obj;
            $objs[] = array(
                'key' => $path,
                'last-modified' => date(DATE_RFC2822, filemtime($this->path . $obj)),
                'content-length' => filesize($this->path . $path),
                'content-type' => $this->get_mimetype($obj),
            );
        }
        return $objs;
    }

    public function saveText($object, $content, $exp_time = null)
    {
        return $this->saveObj($object, $content, $exp_time);
    }

    public function saveObj($object, $content, $exp_time = null)
    {
        $this->chkeck_path($object);
        $path = $this->path . $object;
        $rs = @file_put_contents($path, $content);
        return $rs ? true : $this->except('上传到 Storage 的文件路径不正确.');
    }

    public function saveFile($object, $from)
    {
        $this->chkeck_path($object);
        $this->chkeck_path($from);
        return @copy($from, $this->path . $object);
    }

    public function copy($from, $to)
    {
        $this->chkeck_path($from);
        $this->chkeck_path($to);
        $realfrom = $this->path . $from;
        $realto = $this->path . $to;
        if(!is_file($realfrom)) return false;
        $this->make_dir($realto);
        $rs = @copy($realfrom, $realto);
        return $rs;
    }

    public function move($from, $to)
    {
        if($rs = $this->copy($from, $to))
            return @unlink($this->path . $from);
        return false;
    }

    public function getMeta($object)
    {
        $this->chkeck_path($object);
        return array(
            'content-type' => 
                $this->get_mimetype($object),
            'content-length' => filesize($this->path . $object),
            'etag' => sha1(microtime()),
            'last-modified' => 
                date(DATE_RFC2822, filemtime($this->path . $object)),
        );
    }

    public function delete($object)
    {
        $this->chkeck_path($object);
        return @unlink($this->path . $object);
    }

    public function get($object, $path = null) 
    {
        $this->chkeck_path($object);
        $realpath = $this->path . $object;
        return $path ? @copy($realpath, $path) : 
            @file_get_contents($realpath);
    }

    public function fileExists($object)
    {
        $this->chkeck_path($object);
        return @file_exists($this->path . $object);
    }


    # ============================ #
    private function chkeck_path($path) 
    {
        // realpath
        $dir_path = $this->canonicalize() . DIRECTORY_SEPARATOR;
        $check_path = str_replace($dir_path, '', $this->canonicalize($path));
        if($path === $check_path)
            return true;
        $this->except('您存储 storage 的路径非法: ' . $path);
    }

    private function except($msg) 
    {
        throw new Exception($msg);
    }

    private function make_dir($filepath)
    {
        if(!$filepath) return;
        $dir_path = dirname($filepath);
        if(!is_dir($dir_path))  {
            if(is_file($dir_path)) @unlink($dir_path);
            @mkdir($dir_path, 0700, true);
        }
    }

    private function get_mimetype($fname) 
    {
        $def = 'application/octet-stream';
        $info = pathinfo($fname);
        if(!isset($info['extension'])) return $def;
        $ext = strtolower($info['extension']);
        return isset($this->mime_types[$ext]) ? 
            $this->mime_types[$ext] : $def;
    }

    private function read_dir($path)
    {
        $dirs = array();
        if($handle = @opendir($path)) {
           while(false !== ($item = @readdir($handle))) {
               if($item && ($item != ".") && ($item != ".."))
                   $dirs[] = $item;
           }
           @closedir($handle);
        }
        return $dirs;
    }

    private function canonicalize($path = null)
    {
        if ($path == null || $path{0} != DIRECTORY_SEPARATOR)
            $path=getcwd() . DIRECTORY_SEPARATOR . $path;
        $path = str_replace(array(DIRECTORY_SEPARATOR, '\\', '//'), DIRECTORY_SEPARATOR, $path);
        $parts = array_filter(explode(DIRECTORY_SEPARATOR, $path), 'strlen');
        $absolutes = array();

        foreach ($parts as $part) {
            if ('.'  == $part) continue;
            if ('..' == $part) {
                array_pop($absolutes);
            } else {
                $absolutes[] = $part;
            }
        }
        $path=implode(DIRECTORY_SEPARATOR, $absolutes);
        $path = DIRECTORY_SEPARATOR.$path;
        return $path;
    }
}
