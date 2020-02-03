<?php
session_start();

if(isset($_POST['gerarpdf-submit'])){

require "../fpdf/fpdf.php";

$data_escolhida0 = $_POST['data'];

$time = strtotime($data_escolhida0); 
$data_escolhida = date("Y-m-d", $time);

$db = new PDO('mysql:host=localhost;dbname=dblpa','root','');

class myPDF extends FPDF{
    function header(){
        
        $data_escolhida = $_POST['data'];

        //$this->image('logo.jpg', 10, 6);
        $this->SetFont('Arial', 'B', 14);
        $this->Cell(189, 5, 'CADERNO DE REGISTROS', 0, 0, 'C');
        $this->Ln();
        $this->SetFont('Times', '', 12);
        $this->Cell(189, 10, 'Registros do dia '.$data_escolhida, 0, 0, 'C'); // 276
        $this->Ln(20);
    }
    function footer(){
        $this->SetY(-15);
        $this->SetFont('Arial', '', 8);
        $str_pagina = "Página ";
        $str_pagina = iconv('UTF-8', 'windows-1252', $str_pagina);
        $this->Cell(0, 10, $str_pagina.$this->PageNo().'/{nb}', 0, 0, 'C');
    }
    function headerTable(){
        $this->SetFont('Times', 'B', 12);
        $this->Cell(10, 10, 'ID', 1, 0, 'C');
        $this->Cell(22, 10, 'Data', 1, 0, 'C');
        $this->Cell(18, 10, 'Hora', 1, 0, 'C');
        $str_acao = "Ação";
        $str_acao = iconv('UTF-8', 'windows-1252', $str_acao);
        $this->Cell(20, 10, $str_acao, 1, 0, 'C');
        $this->Cell(63, 10, 'Nome', 1, 0, 'C');
        $str_matricula = "Matrícula";
        $str_matricula = iconv('UTF-8', 'windows-1252', $str_matricula);
        $this->Cell(35, 10, $str_matricula, 1, 0, 'C');
        $this->Cell(21, 10, 'Contagem', 1, 0, 'C');
        $this->Ln();
    }
    function viewTable($db){

        // dd/mm/YYYY -> YYYY-mm-dd
        $data_escolhida = $_POST['data'];
        $data_escolhida_array = explode('/',trim($data_escolhida));
        $data_escolhida_formatada = $data_escolhida_array[2]."-".$data_escolhida_array[1]."-".$data_escolhida_array[0];

        $this->SetFont('Times', '', 12);
        $stmt = $db->query("SELECT * FROM registros WHERE registrosData LIKE '%" . $data_escolhida_formatada . "%'");
        while($data = $stmt->fetch(PDO::FETCH_OBJ)){
            
            $this->Cell(10, 10, $data->registrosId, 1, 0, 'C');

            $time = strtotime($data->registrosData); 
            $myFormatDateForView = date("d/m/Y", $time);
            $this->Cell(22, 10, $myFormatDateForView, 1, 0, 'C');

            $myFormatHourForView = date("H:i:s", $time);
            $this->Cell(18, 10, $myFormatHourForView, 1, 0, 'C');

            $this->Cell(20, 10, $data->registrosRegistro, 1, 0, 'C');
            
            $str_nome = $data->registrosNome;
            $str_nome = iconv('UTF-8', 'windows-1252', $str_nome);
            $this->Cell(63, 10, $str_nome, 1, 0, 'C');

            $this->Cell(35, 10, $data->registrosMatricula, 1, 0, 'C');

            $this->Cell(21, 10, $data->registrosContagem, 1, 0, 'C');

            $this->Ln();
        }
    }
}

// A4 -> dimensões usadas 189 (P) x 276 (L)

$pdf = new myPDF();
$pdf->AliasNbPages();
$pdf->AddPage('P', 'A4', 0); // L -> paisagem, P -> retrato
$pdf->headerTable();
$pdf->viewTable($db);
$pdf->Output();

}

else{
    header("Location: ../index.php");
    exit();
}