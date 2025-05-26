<?php

namespace App\Service;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Collection;
use PhpOffice\PhpSpreadsheet\IOFactory;

class ExcelImportService
{
    public static function import(UploadedFile $file): Collection
    {
        $spreadsheet = IOFactory::load($file->getRealPath());
        $sheet = $spreadsheet->getActiveSheet();

        $data = collect();

        $columnCount = 0;
        foreach ($sheet->getRowIterator(endRow: 1) as $row) {
            $labels = [];
            foreach ($row->getCellIterator() as $cell) {
                $cellValue = $cell->getValue();
                if (!empty($cellValue)) {
                    $labels[] = $cell->getValue();
                    $columnCount++;
                } else {
                    break;
                }
            }
        }

        foreach ($sheet->getRowIterator(2) as $row) {
            $rowData = [];
            foreach ($row->getCellIterator(endColumn: $columnCount) as $cell) {
                $rowData[] = $cell->getValue();
            }
            $data->push($rowData);
        }

        return $data;
    }
}
