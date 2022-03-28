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
        int $presenceId
    ): ResponseInterface {
        $userCpf = $request->getAttribute('cpf_usuario');

        $this->employee->verifyIsAdmin($userCpf);

        $result = $this->presence->updatePresence($presenceId);

        return $this->toJson($response, 200, 'ok', $result);
    }
}