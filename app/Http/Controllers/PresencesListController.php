<?php

namespace App\Http\Controllers;

use App\Models\Presence;
use Illuminate\Routing\Controller as BaseController;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class PresencesListController extends BaseController
{
    public function __construct(
        private Presence $presence
    ){}

    public function list(
        ServerRequestInterface $request,
        ResponseInterface $response
    ): ResponseInterface {
        $employeeCpf = $request->getAttribute('cpf');

        $result = $this->presence->getPresencesByCpf($employeeCpf);

        return $this->toJson($response, 200, 'ok', $result);
    }
}
