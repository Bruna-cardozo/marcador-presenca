<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Employee extends Model
{
    public function __construct(private DB $db){}

    public function verifyIsAdmin(string $employeeCpf): void
    {
        if (DB::table('tabela_funcionarios')
            ->whereRaw('cpf = ? and admin = ?', [$employeeCpf, false])
        ) {
            throw new Exception("Funcionário sem permissão");
        }
    }
}