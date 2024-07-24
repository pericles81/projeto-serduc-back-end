<?php

namespace App\DAO;

use App\Models\StudentsModel;
use PDO;

class StudentsDAO extends Connection{
    public function __construct(){
        parent::__construct();
    }

    public function getAllStudents(): array{
        $students = $this->pdo
            ->query('SELECT * FROM students;')
            ->fetchAll(\PDO::FETCH_ASSOC);
            return $students;
    }
    
        public function getStudentById(int $id): ?array {
            $statement = $this->pdo
                ->prepare('SELECT * FROM students WHERE id = :id');
            $statement->execute(['id' => $id]);
            $school = $statement->fetch(PDO::FETCH_ASSOC);
    
            return $school ? $school : null;
        }
    
    
        public function insertStudents(StudentsModel $student): void{
            $statement = $this->pdo
                ->prepare('INSERT INTO students (cpf, nome, senha, data_nasc, teacher_id)
            VALUES (:cpf, :nome, :senha, :data_nasc, :teacher_id);');
                $statement->execute([
                    'cpf' => $student->getCpf(),
                    'nome' => $student->getNome(),
                    'senha' => $student->getSenha(),
                    'data_nasc' => $student->getDataNasc()->format('Y-m-d'),
                    'teacher_id'=> $student->getTeacherId()
                ]);
        }
    
        public function updateStudents(SchoolsModel $school): void
        {
            $statement = $this->pdo
                ->prepare('UPDATE students SET nome = :nome, endereco = :endereco WHERE id = :id;');
            $statement->execute([
                'nome' => $school->getNome(),
                'endereco' => $school->getEndereco(),
                'id' => $school->getId()
            ]);
        }
    
        public function deleteStudents(int $id): void
        {
            $statement = $this->pdo
            ->prepare('DELETE FROM teachers WHERE escola_id = :id;
            DELETE FROM students WHERE id = :id;');
            
            $statement->execute([
                'id' => $id
            ]);
        }

}