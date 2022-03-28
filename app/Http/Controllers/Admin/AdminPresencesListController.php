<?php

namespace App\Http\Controllers\Admin;

use App\Models\Employee;
use App\Models\Presence;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class AdminPresencesListController extends BaseController
{
    public function __construct(
        private Presence $presence,
        private Employee $employee
    ){}

    public function list(
        ServerRequestInterface $request,
        ResponseInterface $response
    ): ResponseInterface {
        $userCpf = $request->getAttribute('cpf_usuario');
        $initialDate = $request->getAttribute('data_inicial');
        $finalDate = $request->getAttribute('data_final');

        $this->employee->verifyIsAdmin($userCpf);

        $result = $this->presence->getPresencesList(
            $finalDate,
            $initialDate,
        );

        return $this->toJson($response, 200, 'ok', $result);
    }
}
