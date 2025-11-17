# Bolsa de Empleo - TP Recuperatorio 2025

Instrucciones básicas:

1. Clonar repo:
   git clone https://github.com/TU_USUARIO/bolsa-empleo.git

2. Config:
   - Copiar `app/Config/config.php` y ajustar credenciales DB.
   - Importar SQL en phpMyAdmin -> base `bolsa_empleo`.

3. Levantar servidor (sin XAMPP):
   php -S localhost:8000 -t public

4. Estructura:
   /public  => punto de entrada
   /app     => Core, Controllers, Models, Services...
