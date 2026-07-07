<?php

class HeroSlide extends Model
{
    protected $table = 'hero_slides';

    public function getActive()
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE is_active = 1 ORDER BY sort_order ASC, id DESC");
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            return []; // Table might not exist yet
        }
    }

    public function getMaxSortOrder()
    {
        try {
            $stmt = $this->db->query("SELECT MAX(sort_order) as max_order FROM {$this->table}");
            $result = $stmt->fetch();
            return $result->max_order !== null ? (int)$result->max_order : 0;
        } catch (PDOException $e) {
            return 0;
        }
    }
}
