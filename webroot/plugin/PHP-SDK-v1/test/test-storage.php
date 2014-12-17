<?php

$storage = Alibaba::Storage();

file_put_contents("saveTextFile.jpg", 'test');
$res = $storage->saveFile("saveTextFile.jpg", "saveTextFile.jpg");
if (false == $res) {
    exit('saveFile failed.');
}

$res = $storage->saveText("saveTextFile.txt", "OK", -11);
if (false == $res) {
    exit('saveText failed.');
}

$res = $storage->fileExists("saveTextFile.txt");
if (false == $res) {
    exit('fileExists failed.');
}

$res = $storage->move("saveTextFile.txt", "newfile.txt");
if (false == $res) {
    exit('move failed.');
}

if ($storage->get("newfile.txt") != 'OK') {
    exit('get failed.');
}

print_r($storage->getMeta("newfile.txt"));
print_r($storage->copy("newfile.txt", "newfile2.txt"));
print_r($storage->listObject());

$res = $storage->delete("newfile.txt");
if (false == $res) {
    exit('delete failed.');
}
