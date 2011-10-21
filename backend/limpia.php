<?PHP
// create object
$zip = new ZipArchive();

//borramos el anterior
if (file_exists("../data/reporte.zip")) unlink("../data/reporte.zip");

// open archive 
if ($zip->open('../data/reporte.zip', ZIPARCHIVE::CREATE) !== TRUE) {
    die ("Could not open archive");
}

// list of files to add
$fileList = array(
    '../data/ordenes.xml',
);

// add files
foreach ($fileList as $f) {
    $zip->addFile($f) or die ("ERROR: Could not add file: $f");   
}
    
// close and save archive
$zip->close();
echo "Reporte creado.";

//borramos el archivo de ordenes
$myFile = "../data/ordenes.xml";
$fh = fopen($myFile, 'w') or die("can't open file");
$clear = '<?xml version="1.0" encoding="UTF-8"?><ordenes></ordenes>';
fwrite($fh, $clear);
fclose($fh);

?> 
<a href="../data/reporte.zip"/>Bajar el reporte</a>