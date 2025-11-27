<?php
namespace App\Models\Repositories;

use App\Core\Database;
use App\Models\Entities\Empresa;
use PDO;

class MySQLEmpresaRepository implements EmpresaRepositoryInterface
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

    public function findById(int $id): ?Empresa
    {
        $stmt = $this->db->prepare('SELECT * FROM empresas WHERE id_empresa = ?');
        $stmt->execute([$id]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$data) return null;

        $empresa = new Empresa();
        $empresa->setIdEmpresa($data['id_empresa'])
                ->setRazonSocial($data['razon_social'])
                ->setCuit($data['cuit'])
                ->setIdRubro($data['id_rubro'])
                ->setDireccion($data['direccion'])
                ->setLocalidad($data['localidad'])
                ->setEmailContacto($data['email_contacto'])
                ->setSitioWeb($data['sitio_web']);
        return $empresa;
    }

    public function save(Empresa $empresa): bool
    {
        $sql = 'INSERT INTO empresas (razon_social, cuit, id_rubro, direccion, localidad, email_contacto, sitio_web) 
                VALUES (?, ?, ?, ?, ?, ?, ?)';
        $stmt = $this->db->prepare($sql);
        
        $success = $stmt->execute([
            $empresa->getRazonSocial(),
            $empresa->getCuit(),
            $empresa->getIdRubro(),
            $empresa->getDireccion(),
            $empresa->getLocalidad(),
            $empresa->getEmailContacto(),
            $empresa->getSitioWeb()
        ]);

        if ($success) {
            $empresa->setIdEmpresa((int)$this->db->lastInsertId());
        }
        return $success;
    }

    public function update(Empresa $empresa): bool
    {
        $sql = 'UPDATE empresas SET razon_social=?, cuit=?, id_rubro=?, direccion=?, localidad=?, email_contacto=?, sitio_web=? WHERE id_empresa=?';
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            $empresa->getRazonSocial(),
            $empresa->getCuit(),
            $empresa->getIdRubro(),
            $empresa->getDireccion(),
            $empresa->getLocalidad(),
            $empresa->getEmailContacto(),
            $empresa->getSitioWeb(),
            $empresa->getIdEmpresa()
        ]);
    }
}