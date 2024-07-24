<?php

namespace App\DAO;

use App\Models\TeachersModel;
use PDO;

class TeachersDAO extends Connection{

    public function __construct(){
        parent::__construct();
    }

    public function getAllTeachers(): array{
        $teachers = $this->pdo
            ->query('SELECT * FROM teachers;')
            ->fetchAll(\PDO::FETCH_ASSOC);
        
            return $teachers;
        }


        public function getSchoolById(int $id): ?array {
            $statement = $this->pdo
                ->prepare('SELECT * FROM schools WHERE id = :id');
            $statement->execute(['id' => $id]);
            $school = $statement->fetch(PDO::FETCH_ASSOC);
    
            return $school ? $school : null;
        }

        public function getTeacherById(string $cpf): ?array {
            $statement = $this->pdo
                ->prepare('SELECT 
        t.cpf AS teacher_cpf,
        t.nome AS teacher_nome,
        t.senha AS teacher_senha,
        t.data_nasc AS teacher_data_nasc,
        t.escola_id AS teacher_escola_id,
        t.cpf_users AS teacher_cpf_users,
        u.nome AS user_nome,
        u.senha AS user_senha,
        u.data_nasc AS user_data_nasc
        FROM 
        teachers t
        INNER JOIN 
        users u ON t.cpf_users = u.cpf
        WHERE t.cpf = :cpf' );

            $statement->execute(['cpf' => $cpf]);
            $teacher = $statement->fetch(PDO::FETCH_ASSOC);
        
            return $teacher ? $teacher : null;
        }

        public function insertTeachers(TeachersModel $teacher): void{
            $statement = $this->pdo
                ->prepare('INSERT INTO teachers(cpf,nome,senha,data_nasc,escola_id,cpf_users) VALUES(
                :cpf,
                :nome,
                :senha,
                :data_nasc,
                :escola_id,
                :cpf_users);');

            $statement->execute([
                'cpf'=>$teacher->getCpf(),
                'nome'=>$teacher->getNome(),
                'senha'=>$teacher->getSenha(),
                'data_nasc'=>$teacher->getDataNasc()->format('Y-m-d'),
                'escola_id'=>$teacher->getEscolaId(),
                'cpf_users'=>$teacher->getCpfUsers()
            ]);
        }

        public function updateTeachers(TeachersModel $teacher): void
        {
            $statement = $this->pdo
                ->prepare('UPDATE teachers SET nome = :nome, senha = :senha, data_nasc = :data_nasc, escola_id = :escola_id WHERE cpf = :cpf;');
            $statement->execute([
                'nome' => $teacher->getNome(),
                'senha' => $teacher->getSenha(),
                'data_nasc' => $teacher->getDataNasc()->format('Y-m-d'),
                'escola_id' => $teacher->getEscolaId(),
                'cpf' => $teacher->getCpf()
            ]);
        }


        public function deleteTeachers(string $cpf): void
        {
            $statement = $this->pdo
            ->prepare('DELETE FROM students WHERE cpf_teachers = :cpf;
            DELETE FROM teachers WHERE cpf = :cpf;');
            
            $statement->execute([
                'cpf' => $cpf
            ]);
        }
}