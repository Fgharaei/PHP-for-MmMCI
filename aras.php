<?php

require 'vendor/autoload.php';

$inputFileName = "gilan_ip.xlsx";
$potPos = strpos($inputFileName, ".");
$outputFileName=substr($inputFileName,0,$potPos);
ini_set('memory_limit', '4096M');
ini_set('max_execution_time', 2000);
//$spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($inputFileName);

$reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader("Xlsx");
$reader->setLoadAllSheets();
$spreadsheetall = $reader->load($inputFileName);
$spreadsheet1=$spreadsheetall->getAllSheets();
$sheetnum=1;
foreach ($spreadsheet1 as $spreadsheet){
$allDataInSheet=$spreadsheet->toArray("", true, true, true);

//$allDataInSheet = $spreadsheet->getActiveSheet()->toArray("", true, true, true);


    $record=array();
    foreach ($allDataInSheet as $value){
        $record[]=$value;
    }
    $jsonoutput1= JSON_encode($record);
//    echo $jsonoutput1;
//    echo $sheetnum;
    $myfile=fopen($outputFileName.$sheetnum.".json","w");
    echo $outputFileName.$sheetnum.".json"."<br>";
    $sheetnum++;
    fwrite($myfile,$jsonoutput1);
    fclose($myfile);
}





