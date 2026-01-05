<?php
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;

include 'config.php'; // Conexiunea la baza de date

// Creează obiectul Excel
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
$sheet->setTitle('Orar Școlar');

// Antetul tabelului
$header = ['ID Orar', 'Ziua', 'Ora', 'Clasa', 'Disciplina', 'Profesor'];

// Scrie antetul în Excel
$sheet->fromArray($header, null, 'A1');

// Preluăm datele din baza de date
$sql = "SELECT id_orar, ziua_saptamanii, ora, id_clasa, id_disciplina, id_profesor 
        FROM orar 
        ORDER BY ziua_saptamanii, ora";

$result = mysqli_query($conn, $sql);

$data = [];
while ($row = mysqli_fetch_assoc($result)) {
    $data[] = [
        $row['id_orar'],         // ID-ul orarului
        $row['ziua_saptamanii'], // Ziua
        $row['ora'],             // Ora
        $row['id_clasa'],        // ID clasa
        $row['id_disciplina'],   // ID disciplina
        $row['id_profesor']      // ID profesor
    ];
}

// Scrie datele în Excel începând cu A2
$sheet->fromArray($data, null, 'A2');

// Stilizare: font 14pt, centrare, borduri
$highestRow = count($data) + 1; // +1 pentru antet
$highestCol = count($header);
$lastColLetter = Coordinate::stringFromColumnIndex($highestCol);
$range = 'A1:' . $lastColLetter . $highestRow;

$sheet->getStyle($range)->applyFromArray([
    'font' => ['size' => 14],
    'alignment' => [
        'horizontal' => Alignment::HORIZONTAL_CENTER,
        'vertical' => Alignment::VERTICAL_CENTER
    ],
    'borders' => [
        'allBorders' => ['borderStyle' => Border::BORDER_THIN]
    ]
]);

// Lățimi automate pentru coloane
foreach (range(1, $highestCol) as $colIndex) {
    $colLetter = Coordinate::stringFromColumnIndex($colIndex);
    $sheet->getColumnDimension($colLetter)->setAutoSize(true);
}

// Export fișier Excel
$filename = 'orar_scolar_' . date('Ymd_His') . '.xlsx';
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header("Content-Disposition: attachment; filename=\"$filename\"");
$writer = new Xlsx($spreadsheet);
$writer->save('php://output');
exit;
?>
