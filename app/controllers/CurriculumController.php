<?php

/**
 * Class CurriculumController
 */
class CurriculumController extends \BaseController {

    /**
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function getByFilename()
    {
        $cv = Request::get("cv");

        $aplicante = AplicanteModel::where("cv", $cv)->firstOrFail();

        $file = cv_path() . $aplicante->cv;

        return Response::download($file);
    }
}