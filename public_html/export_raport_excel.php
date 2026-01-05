<?php
require 'vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Font;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;

// Creează obiectul Excel
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
$sheet->setTitle('Raport Absențe');

// Datele
$header = ['ID', 'ID Elev', 'Data', 'Disciplina', 'Motivată', 'Justificare'];
$data = [
    [1, 3, '2025-11-15', 'Matematică', 'Nu', ''],
    [2, 4, '2025-11-14', 'Istoria', 'Da', ''],
    [3, 5, '2025-11-13', 'Limba română', 'Da', ''],
    [4, 6, '2025-11-11', 'Limba franceză', 'Nu', ''],
    [5, 5, '2025-10-12', 'Matematică', 'Da', 'Boală']
];

// Scrie antetul
$sheet->fromArray($header, null, 'A1');

// Scrie datele
$sheet->fromArray($data, null, 'A2');

// Stilizare: font 14pt, centrare, borduri
$highestRow = count($data) + 1;
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

// Lățimi automate
foreach (range(1, $highestCol) as $colIndex) {
    $colLetter = Coordinate::stringFromColumnIndex($colIndex);
    $sheet->getColumnDimension($colLetter)->setAutoSize(true);
}

// Export
$filename = 'raport_absente_' . date('Ymd_His') . '.xlsx';
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header("Content-Disposition: attachment; filename=\"$filename\"");
$writer = new Xlsx($spreadsheet);
$writer->save('php://output');
exit;
?>
