<?php

namespace App\Http\Controllers;

use App\Models\Treatment;
use Illuminate\Http\Request;
use PhpOffice\PhpWord\Exception\Exception;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class WordController extends Controller
{
    /**
     * @return bool|BinaryFileResponse
     * @throws Exception
     */
    public function getTreatmentsFile(int $id)
    {
        $model = Treatment::find($id);
        return $model->downloadWord();
    }
}
