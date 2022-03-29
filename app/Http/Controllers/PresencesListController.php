<?php

namespace App\Http\Controllers;

use App\Models\Presence;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;
use Psr\Http\Message\ServerRequestInterface;

class PresencesListController extends BaseController
{
    public function __construct(
        private Presence $presence
    ){}

    public function list(
        ServerRequestInterface $request,
    ): JsonResponse {
        $employeeCpf = $request->getAttribute('cpf');

        $result = $this->presence->getPresencesByCpf($employeeCpf);

        return response()->json($result);
    }
}
