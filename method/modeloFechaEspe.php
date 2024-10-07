<?php
class FechaEspecial {
    private static $db;

    public static function setDb($database) {
        self::$db = $database;
    }
    public static function agregarFecha($evento, $fechaInicio, $fechaFin, $colorEvento) {
        $sql = "INSERT INTO tb_fecha_especial (evento, fecha_inicio, fecha_fin, color_evento) VALUES (?, ?, ?, ?)";
        $stmt = self::$db->prepare($sql);
        $stmt->bind_param("ssss", $evento, $fechaInicio, $fechaFin, $colorEvento);
        return $stmt->execute();
    }

    public static function obtenerFechas() {
        $sql = "SELECT id, evento, fecha_inicio, fecha_fin, color_evento FROM tb_fecha_especial";
        $result = self::$db->query($sql);
        return $result;
    }
    public static function eliminarFecha($id) {
        $sql = "DELETE FROM tb_fecha_especial WHERE id = ?";
        $stmt = self::$db->prepare($sql);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}
?>