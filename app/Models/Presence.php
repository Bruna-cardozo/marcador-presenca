<?php

namespace App\Models;

use DateTime;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Presence extends Model
{
    public function __construct(private DB $db){}

    public function getPresencesList(
        ?DateTime $initialDate,
        ?DateTime $finalDate,
    ) {
        $totalPresences = $this->db::table('tabela_presencas')
            ->whereRaw('data_presenca >= ? and data_presenca <= ?', [$initialDate, $finalDate])
            ->get();

        return $totalPresences;
    }

    public function getPresencesByCpf(
        string $cpf
    ) {
        $presences = $this->db::table('tabela_presencas')->where('cpf', $cpf)->get();

        if (!$presences) {
            return [];
        }

        return $presences;
    }

    public function registerNewPresence(
        string $cpf
    ): void {
        $this->verifyEmployee($cpf);

        $date = new DateTime();
        $isPresent = $this->db::table('tabela_presencas')
            ->whereRaw('cpf = ? and data_presença = ?', [$cpf, $date])
            ->get();

        if ($isPresent) {
            throw new Exception("Presença já cadastrada nesta data com este CPF '$cpf'");
        }

        $this->db::table('tabela_presencas')->insert([
            'cpf' => $cpf,
            'data_presenca' => new DateTime(),
            'presente' => 1
        ]);
    }

    public function removePresence(int $presenceId)
    {
        $presenceData = $this->db::table('tabela_presencas')->where('id', $presenceId)->get();

        if (!$presenceData) {
            throw new Exception("Presença com id '$presenceId' não encontrada");
        }

        $this->db::table('tabela_presencas')->delete($presenceId);
    }

    public function updatePresence(int $presenceId)
    {
        $presenceData = $this->db::table('tabela_presencas')->where('id', $presenceId)->get();

        if (!$presenceData) {
            throw new Exception("Presença com id '$presenceId' não encontrada");
        }

        ($presenceData['presente']) ? $newStatus = 0 : $newStatus = 1;

        $this->db::table('tabela_presencas')
            ->where('id', $presenceId)
            ->update(['presente' => $newStatus]);
    }

    private function verifyEmployee(string $employeeCpf): void
    {
        if (DB::table('tabela_funcionarios')->where('cpf', $employeeCpf)->doesntExist()) {
            throw new Exception("Funcionário com cpf '$employeeCpf' não encontrado");
        }
    }
}