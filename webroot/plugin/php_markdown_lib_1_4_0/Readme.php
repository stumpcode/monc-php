<?php

# This file passes the content of the Readme.md file in the same directory
# through the Markdown filter. You can adapt this sample code in any way
# you like.

# Install PSR-0-compatible class autoloader
spl_autoload_register(function ($class) {
    require preg_replace('{\\\\|_(?!.*\\\\)}', DIRECTORY_SEPARATOR, ltrim($class, '\\')) . '.php';
});

# Get Markdown class
use Michelf\MarkdownExtra;

# Read file and pass content through the Markdown parser
$text = file_get_contents('../../../runtime/test1.md');
$html = MarkdownExtra::defaultTransform($text);

ob_start();
?>
    <!DOCTYPE html>
    <html>
    <head>
        <link rel='stylesheet' href='GitHub2.css' type='text/css'></link>
        <title>PHP Markdown Lib - Readme</title>
    </head>
    <body>
    <?php
    # Put HTML content in the document
    echo $html;
    ?>
    </body>
    </html>

<?php

$c = ob_get_contents();
ob_clean();

// $mpdf = new mPDF();
// $mpdf->Bookmark('Start of the document');
// $mpdf->WriteHTML('<div>Section 1 text</div>');
// $c = $mpdf->Output();

file_put_contents('test.html', $c);
file_put_contents('../MPDF57/test.html', $c);


