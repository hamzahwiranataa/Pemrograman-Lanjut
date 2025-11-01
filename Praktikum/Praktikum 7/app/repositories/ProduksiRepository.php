<?php

require_once '../app/core/database.php';
class Repository extends Database
{

    public function restoreBulk($table, $ids) {
        if (empty($ids)) {
            return [
                'success' => false,
                'message' => 'No items selected'
            ];
        }

        try {
            $ids = array_map('intval', $ids);
            $placeholders = str_repeat('?,', count($ids) - 1) . '?';
            
            $sql = "UPDATE {$table} SET hapus = false, deleted_at = NULL WHERE id IN ($placeholders)";
            $stmt = $this->conn->prepare($sql);
            
            $types = str_repeat('i', count($ids));
            $stmt->bind_param($types, ...$ids);
            
            $stmt->execute();
            $affected = $stmt->affected_rows;
            
            return [
                'success' => true,
                'count' => $affected,
                'message' => "{$affected} item(s) restored successfully"
            ];
        } catch (\Exception $e) {
            return [
                'success' => false,
                'message' => 'Error during restore: ' . $e->getMessage()
            ];
        }
    }

    public function forceDeleteBulk($table, $ids) {
        if (empty($ids)) {
            return [
                'success' => false,
                'message' => 'No items selected'
            ];
        }

        try {
            $this->conn->begin_transaction();
            
            $ids = array_map('intval', $ids);
            $placeholders = str_repeat('?,', count($ids) - 1) . '?';
            
            $sql = "DELETE FROM {$table} WHERE id IN ($placeholders)";
            $stmt = $this->conn->prepare($sql);
            
            $types = str_repeat('i', count($ids));      
            $stmt->bind_param($types, ...$ids);
            
            $stmt->execute();
            $affected = $stmt->affected_rows;
            
            $this->conn->commit();
            
            return [
                'success' => true,
                'count' => $affected,
                'message' => $affected > 0 ? 
                    "{$affected} item(s) permanently deleted." :
                    "No items were affected."
            ];
        } catch (\Exception $e) {
            $this->conn->rollback();
            return [
                'success' => false,
                'message' => 'Error during permanent delete: ' . $e->getMessage()
            ];
        }
    }

    public function autoDeleteOld($days = 30) {
        try {
            $totalDeleted = 0;
            $batas = date('Y-m-d H:i:s', strtotime("-{$days} days"));
            
            $tables = ['mesin', 'bahan_baku', 'operator', 'produksi', 'quality_check'];
            
            foreach ($tables as $table) {
                $sql = "DELETE FROM {$table} WHERE hapus = true AND deleted_at IS NOT NULL AND deleted_at < ?";
                $stmt = $this->conn->prepare($sql);
                $stmt->bind_param("s", $batas);
                $stmt->execute();
                $totalDeleted += $stmt->affected_rows;
            }
            
            return [
                'success' => true,
                'count' => $totalDeleted,
                'message' => "Successfully deleted {$totalDeleted} records older than {$days} days"
            ];
        } catch (\Exception $e) {
            return [
                'success' => false,
                'count' => 0,
                'message' => 'Error during auto delete: ' . $e->getMessage()
            ];
        }
    }
}
?>