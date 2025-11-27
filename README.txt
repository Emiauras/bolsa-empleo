# 🌸 Sistema de Bolsa de Empleo (MVP)

Sistema de gestión de empleos desarrollado para la materia **Paradigmas y Lenguajes de Programación 2**.
El proyecto implementa una arquitectura **MVC propia** en **PHP 8 Puro**, utilizando **MySQL** y principios **SOLID**.

## 🚀 Características Principales

- **4 Tipos de Perfiles:**
  - 👤 **Persona:** Carga de CV y postulaciones básicas.
  - 🎓 **Profesional:** Gestión de matrícula y formación académica.
  - 🚀 **Emprendedor:** Difusión de proyectos y emprendimientos.
  - 🏢 **Empresa:** Publicación de ofertas y gestión de candidatos.
- **Gestión de Ofertas:** Publicación, búsqueda avanzada y filtrado.
- **Postulaciones:** Seguimiento de estado (Enviado, Preseleccionado, Rechazado).
- **Documentación:** Carga de CVs en PDF/Word.
- **Arquitectura Limpia:** Separación en Controladores, Servicios y Repositorios.

## 🛠️ Tecnologías y Patrones

- **Lenguaje:** PHP 8.1+
- **Base de Datos:** MySQL / MariaDB
- **Frontend:** Bootstrap 5 (Diseño Responsivo)
- **Patrones de Diseño:**
  - 🏭 **Factory Method:** Creación dinámica de perfiles de postulantes.
  - 🧠 **Strategy:** Filtros de búsqueda de ofertas (por Título/Rubro).
  - 📦 **Repository:** Abstracción de capa de datos (PDO).
  - 💉 **Dependency Injection:** Contenedor de servicios propio.
  - 🔒 **Singleton:** Conexión a Base de Datos.

## ⚙️ Instalación y Configuración

### 1. Requisitos Previos
- Servidor Web (Apache/Nginx) o PHP Built-in Server.
- PHP 8.0 o superior.
- MySQL.

### 2. Base de Datos
1. Crear una base de datos llamada `bolsa_empleo`.
2. Importar el archivo `bolsa_empleo.sql` ubicado en la raíz del proyecto.

### 3. Configuración del Entorno
1. Navegar a `app/Config/database.php` y configurar tus credenciales:
   ```php
   return [
       'host'     => 'localhost',
       'dbname'   => 'bolsa_empleo',
       'user'     => 'root',
       'password' => '', // Tu contraseña
       // ...
   ];
