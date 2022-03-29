<?php

namespace App\Http\Controllers\Admin;

use App\Models\Employee;
use App\Models\Presence;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;
use Psr\Http\Message\ServerRequestInterface;

class AdminPresencesListController extends BaseController
{
    public function __construct(
        private Presence $presence,
        private Employee $employee
    ){}

    public function list(
        ServerRequestInterface $request
    ): JsonResponse {
        $userCpf = $request->getAttribute('cpf_usuario');
        $initialDate = $request->getAttribute('data_inicial');
        $finalDate = $request->getAttribute('data_final');

        $this->employee->verifyIsAdmin($userCpf);

        $result = $this->presence->getPresencesList(
            $finalDate,
            $initialDate,
        );

        return response()->json($result);
    }
}
