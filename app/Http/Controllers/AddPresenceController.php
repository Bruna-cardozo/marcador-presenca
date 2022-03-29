<?php

namespace App\Http\Controllers;

use App\Models\Presence;
use Illuminate\Http\JsonResponse;
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
    ): JsonResponse {
        $employeeCpf = $request->getAttribute('cpf');

        $this->presence->registerNewPresence($employeeCpf);

        return response()->json([
            'message' => 'Presença registrada com sucesso'
        ]);
    }
}