<?php 

namespace App\DAO;

use App\Models\SchoolsModel;
use PDO;

class SchoolsDAO extends Connection{
    
    public function __construct(){
        parent::__construct();
    }

    public function getAllSchools(): array{
    $schools = $this->pdo
        ->query('SELECT * FROM schools;')
        ->fetchAll(\PDO::FETCH_ASSOC);
    
        return $schools;
    }

    public function getSchoolById(int $id): ?array {
        $statement = $this->pdo
            ->prepare('SELECT * FROM schools WHERE id = :id');
        $statement->execute(['id' => $id]);
        $school = $statement->fetch(PDO::FETCH_ASSOC);

        return $school ? $school : null;
    }


    public function insertSchools(SchoolsModel $school): void{
        $statement = $this->pdo
            ->prepare('INSERT INTO schools VALUES(
            null,
            :nome,
            :endereco);');
            $statement->execute([
                'nome'=>$school->getNome(),
                'endereco'=>$school->getEndereco()
            ]);
    }

    public function updateSchools(SchoolsModel $school): void
    {
        $statement = $this->pdo
            ->prepare('UPDATE schools SET nome = :nome, endereco = :endereco WHERE id = :id;');
        $statement->execute([
            'nome' => $school->getNome(),
            'endereco' => $school->getEndereco(),
            'id' => $school->getId()
        ]);
    }

    public function deleteSchools(int $id): void
    {
        $statement = $this->pdo
        ->prepare('DELETE FROM teachers WHERE escola_id = :id;
        DELETE FROM schools WHERE id = :id;');
        
        $statement->execute([
            'id' => $id
        ]);
    }
}