<?php

namespace Model;

use Core\Model;
use PDO;

class User extends Model
{
    public static function getAll() {
        $stmt = self::getDB()->query("SELECT * FROM user");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getById(int $id) {
        $stmt = self::getDB()->prepare("SELECT * FROM user WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}