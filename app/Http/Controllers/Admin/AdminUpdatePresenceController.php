<?php

namespace App\Http\Controllers\Admin;

use App\Models\Presence;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;
use Psr\Http\Message\ServerRequestInterface;

class AdminUpdatePresenceController extends BaseController
{
    public function __construct(
        private Presence $presence
    ){}

    public function update(
        ServerRequestInterface $request,
        int $presenceId
    ): JsonResponse {
        $userCpf = $request->getAttribute('cpf_usuario');

        $this->employee->verifyIsAdmin($userCpf);

        $this->presence->updatePresence($presenceId);

        return response()->json([
            'message' => 'Presença atualizada com sucesso'
        ]);
    }
}