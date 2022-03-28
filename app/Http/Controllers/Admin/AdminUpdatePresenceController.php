<?php

namespace App\Http\Controllers\Admin;

use App\Models\Presence;
use Illuminate\Routing\Controller as BaseController;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class AdminUpdatePresenceController extends BaseController
{
    public function __construct(
        private Presence $presence
    ){}

    public function update(
        ServerRequestInterface $request,
        ResponseInterface $response,
    ): ResponseInterface {
        $userCpf = $request->getAttribute('cpf_usuario');
        $employeeCpf = $request->getAttribute('cpf');
        $date = $request->getAttribute('date');

        $this->employee->verifyIsAdmin($userCpf);

        $result = $this->presence->updatePresence($employeeCpf, $date);

        return $this->toJson($response, 200, 'ok', $result);
    }
}