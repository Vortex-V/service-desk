<?php

namespace App\Service;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Collection;
use PhpOffice\PhpSpreadsheet\IOFactory;

class ExcelImportService
{
    public static function import(UploadedFile $file, array $map): Collection
    {
        $spreadsheet = IOFactory::load($file->getRealPath());
        $sheet = $spreadsheet->getActiveSheet();


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

        $data = [];
        foreach ($sheet->getRowIterator(2) as $row) {
            $rowData = [];
            $cellNumber = 0;
            foreach ($row->getCellIterator(
                endColumn: range('A', 'Z')[$columnCount-1]
            ) as $cell) {
                $cellValue = $cell->getValue();
                if (empty($cellValue)) {
                    break;
                }
                $rowData[$map[$cellNumber]] = $cellValue;
                $cellNumber++;
            }
            if (!empty($rowData)) {
                $data[] = $rowData;
            }
        }

        return collect($data);
    }
}
