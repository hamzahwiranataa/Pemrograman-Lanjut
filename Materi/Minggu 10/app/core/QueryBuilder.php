<?php

require_once 'Database.php';

class QueryBuilder {
    private PDO $pdo;
    private string $table;
    private string $query = "";
    private array $bindings = [];

    public function __construct() {
        $db = new Database();
        $this->pdo = $pdo = $db->getConnection();
    }

    public function table(string $table): self
    {
        $this->table = $table;
        return $this;
    }

    public function select(array $columns = ['*']): self
    {
        $columnsList = implode(', ', $columns);
        $this->query = "SELECT $columnsList FROM {$this->table}";
        $this->bindings = [];
        return $this;
    }

    public function where(string $column, string $operator, mixed $value): self
    {
        $placeholder = ':' . $column;
        $this->query .= (str_contains($this->query, 'WHERE') ? " AND" : " WHERE") . " $column $operator $placeholder";
        $this->bindings[$placeholder] = $value;
        return $this;
    }

    public function insert(array $data): bool
    {
        $columns = implode(", ", array_keys($data));
        $placeholders = implode(", ", array_fill(0, count($data), "?"));
        $sql = "INSERT INTO {$this->table} ($columns) VALUES ($placeholders)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute(array_values($data));
    }



    public function update(array $data): self
    {
        $set = implode(', ', array_map(fn($col) => "$col = :$col", array_keys($data)));
        $this->query = "UPDATE {$this->table} SET $set";
        foreach ($data as $key => $value) {
            $this->bindings[":$key"] = $value;
        }
        return $this;
    }

    public function delete(): self
    {
        $this->query = "DELETE FROM {$this->table}";
        return $this;
    }

    public function execute(): bool
    {
        $pdo = Database::getConnection();
        $stmt = $pdo->prepare($this->query);
        return $stmt->execute($this->bindings);
    }

    public function get(): array 
    {
        $pdo = Database::getConnection();
        $stmt = $pdo->prepare($this->query);
        $stmt->execute($this->bindings);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);   
    }
}
?>