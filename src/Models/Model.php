<?php

namespace Src\Models;

use Src\Models\Database;
use PDO;

class Model
{
    protected $db;
    protected $table; // Nome da tabela no banco de dados
    protected $primaryKey = 'id'; // Chave primária da tabela

    public function __construct()
    {
        $this->db = Database::getInstance(); // Obtém a instância do banco de dados
    }

    // Obtém a instância do banco de dados
    protected function getDb()
    {
        return $this->db;
    }

    // Cria um novo registro
    public function create(array $data)
    {
        $columns = implode(', ', array_keys($data));
        $placeholders = implode(', ', array_fill(0, count($data), '?'));

        $sql = "INSERT INTO {$this->table} ({$columns}) VALUES ({$placeholders})";
        $stmt = $this->db->prepare($sql);

        if ($stmt->execute(array_values($data))) {
            return $this->db->lastInsertId();
        }

        return false;
    }

    // Busca um registro pelo ID
    public function find($id)
    {
        $sql = "SELECT * FROM {$this->table} WHERE {$this->primaryKey} = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Atualiza um registro pelo ID
    public function update($id, array $data)
    {
        $setClause = implode(', ', array_map(fn($key) => "{$key} = ?", array_keys($data)));

        $sql = "UPDATE {$this->table} SET {$setClause} WHERE {$this->primaryKey} = ?";
        $stmt = $this->db->prepare($sql);

        $data[] = $id; // Adiciona o ID ao final do array de valores
        return $stmt->execute(array_values($data));
    }

    // Deleta um registro pelo ID
    public function delete($id)
    {
        $sql = "DELETE FROM {$this->table} WHERE {$this->primaryKey} = ?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$id]);
    }

    // Busca todos os registros
    public function all()
    {
        $sql = "SELECT * FROM {$this->table}";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Executa uma query customizada
    public function query($sql, $params = [])
    {
        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
