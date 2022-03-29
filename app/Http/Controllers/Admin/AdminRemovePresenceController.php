<?php

namespace App\Http\Controllers\Admin;

use App\Models\Presence;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;
use Psr\Http\Message\ServerRequestInterface;

class AdminRemovePresenceController extends BaseController
{
    public function __construct(
        private Presence $presence
    ){}

    public function remove(
        ServerRequestInterface $request,
        int $presenceId
    ): JsonResponse {
        $userCpf = $request->getAttribute('cpf_usuario');

        $this->employee->verifyIsAdmin($userCpf);

        $this->presence->removePresence($presenceId);

        return response()->json([
            'message' => 'Presença revogada com sucesso'
        ]);
    }
}