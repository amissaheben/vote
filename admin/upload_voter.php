<?php

$connect = mysqli_connect("localhost", "root", "", "votesystem");

include ("PHPExcel/IOFactory.php");
$html="<table border='1'>";
$objPHPExcel = PHPExcel_IOFactory::load('temp_upload.xls');
foreach ($objPHPExcel->getWorksheetIterator() as $worksheet)
{
    $highestRow = $worksheet->getHighestRow();
    for ($row=2; $row<=$highestRow; $row++)
    {
        $html.="<tr>";
        $id = mysqli_real_escape_string($connect, $worksheet->getCellByColumnAndRow(0, $row)->getValue());
        $voter_id = mysqli_real_escape_string($connect, $worksheet->getCellByColumnAndRow(1, $row)->getValue());
        $password = mysqli_real_escape_string($connect, $worksheet->getCellByColumnAndRow(2, $row)->getValue());
        $firstname = mysqli_real_escape_string($connect, $worksheet->getCellByColumnAndRow(3, $row)->getValue());
        $lastname = mysqli_real_escape_string($connect, $worksheet->getCellByColumnAndRow(4, $row)->getValue());
        $photo = mysqli_real_escape_string($connect, $worksheet->getCellByColumnAndRow(5, $row)->getValue());
        $sql = "INSET INTO voters(id, voter_id, password, firstname, lastname, photo) VALUES ('.$id','.$voter_id', '.$password', '.$firstname', '.$lastname', '.$photo')";
        mysqli_query($connect, $sql);
        $html.= '<td>'.$id.'</td>';
        $html.= '<td>'.$voter_id.'</td>';
        $html.= '<td>'.$password.'</td>';
        $html.= '<td>'.$firstname.'</td>';
        $html.= '<td>'.$lastname.'</td>';
        $html.= '<td>'.$photo.'</td>';
        $html.="</tr>";
    }
}
$html.="</table>";
echo $html;
echo '<br/>Data Inserted'

?>