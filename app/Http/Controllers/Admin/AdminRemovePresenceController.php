<?php

namespace App\Http\Controllers\Admin;

use App\Models\Presence;
use Illuminate\Routing\Controller as BaseController;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class AdminRemovePresenceController extends BaseController
{
    public function __construct(
        private Presence $presence
    ){}

    public function remove(
        ServerRequestInterface $request,
        ResponseInterface $response,
        int $presenceId
    ): ResponseInterface {
        $userCpf = $request->getAttribute('cpf_usuario');

        $this->employee->verifyIsAdmin($userCpf);

        $result = $this->presence->removePresence($presenceId);

        return $this->toJson($response, 200, 'ok', $result);
    }
}