<?php
class Encuesta {
    private $pdo;

    public function __construct() {
        $this->pdo = getPDOConnection();
    }

    // ---------------- Métodos de creación ----------------
    public function crearEncuesta($idCreador, $titulo, $descripcion) {
        $stmt = $this->pdo->prepare("INSERT INTO encuestas (id_creador, titulo, descripcion) VALUES (?, ?, ?)");
        return $stmt->execute([$idCreador, $titulo, $descripcion]);
    }

    public function crearPregunta($idEncuesta, $textoPregunta) {
        $stmt = $this->pdo->prepare("INSERT INTO preguntas (id_encuesta, texto_pregunta) VALUES (?, ?)");
        return $stmt->execute([$idEncuesta, $textoPregunta]);
    }

    public function guardarRespuesta($idPregunta, $idUsuario, $valorRespuesta) {
        $sql = "INSERT INTO respuestas (id_pregunta, id_usuario, valor_respuesta) 
                VALUES (?, ?, ?)
                ON DUPLICATE KEY UPDATE valor_respuesta = VALUES(valor_respuesta), created_at = NOW()";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$idPregunta, $idUsuario, $valorRespuesta]);
    }

    // ---------------- Métodos de consulta ----------------
    public function getEncuestasPorUsuario($idUsuario) {
        $stmt = $this->pdo->prepare("SELECT * FROM encuestas WHERE id_creador = ?");
        $stmt->execute([$idUsuario]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getEncuestasDeOtrosUsuarios($idUsuario) {
        $stmt = $this->pdo->prepare("SELECT * FROM encuestas WHERE id_creador != ?");
        $stmt->execute([$idUsuario]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getEncuestaPorId($idEncuesta) {
        $stmt = $this->pdo->prepare("SELECT * FROM encuestas WHERE id = ?");
        $stmt->execute([$idEncuesta]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getPreguntasPorEncuesta($idEncuesta) {
        $stmt = $this->pdo->prepare("SELECT * FROM preguntas WHERE id_encuesta = ?");
        $stmt->execute([$idEncuesta]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getRespuestasPorEncuesta($idEncuesta) {
        $sql = "SELECT r.*, p.texto_pregunta 
                FROM respuestas r
                JOIN preguntas p ON r.id_pregunta = p.id
                WHERE p.id_encuesta = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$idEncuesta]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getTotalRespuestasEncuesta($idEncuesta) {
        $sql = "SELECT COUNT(DISTINCT id_usuario) as total 
                FROM respuestas r
                JOIN preguntas p ON r.id_pregunta = p.id
                WHERE p.id_encuesta = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$idEncuesta]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ? $row['total'] : 0;
    }

    // ---------------- Métodos de eliminación ----------------
    public function eliminarEncuesta($idEncuesta) {
        $stmt = $this->pdo->prepare("DELETE FROM encuestas WHERE id = ?");
        return $stmt->execute([$idEncuesta]);
    }

    // ---------------- Métodos auxiliares ----------------
    public function getUltimoIdInsertado() {
        return $this->pdo->lastInsertId();
    }
}
