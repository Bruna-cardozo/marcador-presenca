<?php

namespace App\Http\Controllers;

use App\Models\Presence;
use Illuminate\Routing\Controller as BaseController;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class AddPresenceController extends BaseController
{
    public function __construct(
        private Presence $presence
    ){}

    public function add(
        ServerRequestInterface $request,
        ResponseInterface $response,
    ): ResponseInterface {
        $employeeCpf = $request->getAttribute('cpf');

        $result = $this->presence->registerNewPresence($employeeCpf);

        return $this->toJson($response, 200, 'ok', $result);
    }
}