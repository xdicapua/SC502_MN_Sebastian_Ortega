<?php
class EncuestasController {
    private $encuestaModel;

    public function index() {
        $userId = $_SESSION['user_id'];
        $misEncuestas = $this->encuestaModel->getEncuestasPorUsuario($userId);
        $otrasEncuestas = $this->encuestaModel->getEncuestasDeOtrosUsuarios($userId);
        require 'app/views/encuestas/index.php';
    }

    public function crearPregunta() {
        require 'app/views/encuestas/crearPregunta.php';
    }

    public function responderP($idEncuesta) {
        $encuesta = $this->encuestaModel->getEncuestaPorId($idEncuesta);
        $preguntas = $this->encuestaModel->getPreguntasPorEncuesta($idEncuesta);
        require 'app/views/encuestas/responderP.php';
    }

    public function verRespuestas($idEncuesta) {
        $encuesta = $this->encuestaModel->getEncuestaPorId($idEncuesta);
        $userId = $_SESSION['user_id'];

        if ($encuesta['id_creador'] != $userId) {
            header('Location: /encuestas/encuestas/index');
            exit();
        }

        $preguntas = $this->encuestaModel->getPreguntasPorEncuesta($idEncuesta);
        $respuestas = $this->encuestaModel->getRespuestasPorEncuesta($idEncuesta);
        $totalRespuestas = $this->encuestaModel->getTotalRespuestasEncuesta($idEncuesta);
        

        require 'app/views/encuestas/verRespuestas.php';
    }

    public function guardar() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            require 'app/views/encuestas/crearPregunta.php';
            return;
        }

        $idCreador = $_SESSION['user_id'];
        $titulo = $_POST['titulo'] ?? '';
        $descripcion = $_POST['descripcion'] ?? '';
        $preguntas = $_POST['preguntas'] ?? [];

        if (!$titulo) {
            $error = "El título es obligatorio.";
            require 'app/views/encuestas/crearPregunta.php';
            return;
        }

        $resultado = $this->encuestaModel->crearEncuesta($idCreador, $titulo, $descripcion);

        if ($resultado) {
            $idEncuesta = $this->encuestaModel->getUltimoIdInsertado();

            foreach ($preguntas as $textoPregunta) {
                if (trim($textoPregunta) !== '') {
                    $this->encuestaModel->crearPregunta($idEncuesta, $textoPregunta);
                }
            }

            header('Location: /encuestas/encuestas/index');
            exit();
        } else {
            $error = "Error al crear la encuesta.";
            require 'app/views/encuestas/crearPregunta.php';
        }
    }

    public function guardarRespuestas() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $idUsuario = $_SESSION['user_id'];
            $idEncuesta = $_POST['id_encuesta'];
            $respuestas = $_POST['respuestas'] ?? [];

            foreach ($respuestas as $idPregunta => $valorRespuesta) {
                $this->encuestaModel->guardarRespuesta($idPregunta, $idUsuario, $valorRespuesta);
            }

            header('Location: /encuestas/encuestas/index');
            exit();
        }
    }

    public function eliminar($idEncuesta) {
        $encuesta = $this->encuestaModel->getEncuestaPorId($idEncuesta);
        $userId = $_SESSION['user_id'];

        if ($encuesta['id_creador'] != $userId) {
            header('Location: /encuestas/encuestas/index');
            exit();
        }

        $this->encuestaModel->eliminarEncuesta($idEncuesta);
        header('Location: /encuestas/encuestas/index');
        exit();
    }

    public function __construct() {
        $this->encuestaModel = new Encuesta();
        if (!isset($_SESSION['user_id'])) {
            header('Location: /encuestas/auth/login');
            exit();
        }
    }
}
