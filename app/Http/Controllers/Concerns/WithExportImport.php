<?php

namespace App\Http\Controllers\Concerns;

use App\Support\Response\ApiResponse;
use Illuminate\Http\Request;
use Rap2hpoutre\FastExcel\FastExcel;

trait WithExportImport
{
    public function import(Request $request)
    {
        $validated = $request->validate([
            'file' => 'required|mimes:xls,xlsx',
        ]);

        $cols = $this->repository->getModel()->getFillable();

        $result = (new FastExcel)->import($request->file('file'), function ($line) use ($cols) {
            $values = [];

            foreach ($cols as $col) {
                $values[] = $line[$col] ?? null;
            }

            return $this->repository->store(array_combine($cols, $values));
        });

        return ApiResponse::data(message: count($result).' imported');
    }

    public function export(Request $request)
    {
        // $data = $this->repository->exportWithGenerator()->export($request);
        $name = strtolower($this->repository->getModel()->getTable());

        return (new FastExcel($this->repository->exportGenerator($request)))->download("export_$name.xlsx");
    }

    public function template()
    {
        $model = $this->repository->getModel();
        $name = strtolower($model->getTable());
        $cols = $model->getFillable();
        $values = [];

        foreach ($cols as $col) {
            $values[] = '';
        }

        return (new FastExcel(
            [
                array_combine($cols, $values),
            ]
        ))->download("template_$name.xlsx");
    }
}
