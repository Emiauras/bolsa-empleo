<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Core\Container;
use App\Services\PostulanteService; 
use App\Core\SessionHelper;
use App\Core\UrlHelper;

class PostulanteController extends Controller
{
    private PostulanteService $postulanteService;

    public function __construct(Container $container)
    {
        parent::__construct($container); 
        $this->postulanteService = $container->get(PostulanteService::class);
    }

    //---------------------------------------------------------
    // DASHBOARD / PERFIL
    //---------------------------------------------------------

    public function miPerfil()
    {
        if (!SessionHelper::get('user_id')) {
            header('Location: ' . UrlHelper::base('/login'));
            return;
        }

        $idPostulante = SessionHelper::get('postulante_id');
        
        try {
            $perfilData = $this->postulanteService->getProfile($idPostulante);
        } catch (\Exception $e) {
            SessionHelper::setFlash('error', 'Error al cargar perfil: ' . $e->getMessage());
            $perfilData = [];
        }

        $this->view('postulantes/perfil', ['perfil' => $perfilData]);
    }

    //---------------------------------------------------------
    // SELECCIÓN DE TIPO
    //---------------------------------------------------------

    public function seleccionarTipo()
    {
        if (!SessionHelper::get('user_id')) {
            header('Location: ' . UrlHelper::base('/login'));
            return;
        }

        $tipos = [ 
            1 => 'Persona que busca empleo',
            2 => 'Profesional',
            3 => 'Emprendedor',
            4 => 'Empresa'
        ];
        
        $this->view('postulantes/seleccionar_tipo', ['tipos' => $tipos]); 
    }

    //---------------------------------------------------------
    // FORMULARIOS Y GUARDADO
    //---------------------------------------------------------

    public function showProfileForm()
    {
        if (!SessionHelper::get('user_id')) {
            header('Location: ' . UrlHelper::base('/login'));
            return;
        }

        $tipo = (int)($_GET['tipo'] ?? 0);
        $idPostulante = SessionHelper::get('postulante_id');
        $perfilData = $this->postulanteService->getProfile($idPostulante);

        switch ($tipo) {
            case 1:
                $this->view('postulantes/form_persona', ['perfil' => $perfilData]);
                break;
            case 2:
                $this->view('postulantes/form_profesional', ['perfil' => $perfilData]);
                break;
            case 3:
                $this->view('postulantes/form_emprendedor', ['perfil' => $perfilData]);
                break;
            case 4:
                $this->view('empresas/form_empresa', ['perfil' => $perfilData]); 
                break;
            default:
                SessionHelper::setFlash('error', 'Debes seleccionar un tipo de perfil válido.');
                header('Location: ' . UrlHelper::base('/postulantes/seleccionar-tipo'));
        }
    }
    
    public function storeProfile()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !SessionHelper::get('user_id')) {
             header('Location: ' . UrlHelper::base('/'));
             return;
        }
        
        $tipo = (int)($_GET['tipo'] ?? 0);
        $idPostulante = SessionHelper::get('postulante_id');
        
        try {
            $this->postulanteService->updateProfile($idPostulante, $tipo, $_POST);
            
            // Actualizar el tipo en la sesión
            SessionHelper::set('postulante_tipo', $tipo); 
            
            SessionHelper::setFlash('success', 'Perfil actualizado con éxito. ✅');
            header('Location: ' . UrlHelper::base('/perfil'));
            return;

        } catch (\Exception $e) {
            SessionHelper::setFlash('error', $e->getMessage());
            $redirectUrl = UrlHelper::base('/postulantes/completar-perfil') . "?tipo={$tipo}";
            header("Location: {$redirectUrl}");
            return;
        }
    }
} 
// ¡ASEGÚRATE DE QUE ESTA ÚLTIMA LLAVE CIERRE LA CLASE!