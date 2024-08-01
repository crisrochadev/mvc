<?php
namespace Src\Models;

class User extends Model
{
    protected $table = 'users'; // Nome da tabela no banco de dados

    // Busca um usuário pelo nome de usuário
    public static function findByUsername($username)
    {
        // Cria uma instância da classe para acessar o método getDb
        $instance = new self();
        $db = $instance->getDb(); // Obtém a conexão com o banco de dados
        $stmt = $db->prepare("SELECT * FROM {$instance->table} WHERE username = :username LIMIT 1");
        $stmt->execute(['username' => $username]);
        return $stmt->fetchObject('Src\Models\User');
    }

    // Busca um usuário pelo ID (sobrescreve o método da classe base Model)
    public function find($id)
    {
        $sql = "SELECT * FROM {$this->table} WHERE {$this->primaryKey} = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetchObject('Src\Models\User');
    }
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
}
