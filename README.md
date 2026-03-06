# VIP2CARS — Gestión de Vehículos y Contactos (CRUD)

Sistema de gestión para el rubro automotriz desarrollado en **Laravel 11**. Permite administrar vehículos y sus propietarios (clientes) con validaciones completas, búsqueda y paginación.

---

## 🔧 Requisitos del Entorno

- **PHP**: ^8.2 (Recomendado 8.2.12 o superior)
- **Base de Datos**: MySQL / MariaDB (XAMPP compatible)
- **Servidor Web**: Artisan Serve

---

## 🧰 Instalación y Configuración

1. **Clonar/Descargar el proyecto** en la carpeta de su servidor local 
2. **Instalar dependencias**:
   ```bash
   composer install
   ```
3. **Configurar variables de entorno**:
   Copie el archivo `.env.example` a `.env` y ajuste las credenciales de su base de datos.
   ```bash
   cp .env.example .env
   ```
   Asegúrese de que `DB_DATABASE=vip2cars` coincida con su DB local.

4. **Generar clave de aplicación**:
   ```bash
   php artisan key:generate
   ```

---

## ▶️ Puesta en Marcha

1. **Crear la Base de Datos**:
   Desde PHPMyAdmin o consola MySQL: `CREATE DATABASE vip2cars;`
2. **Ejecutar Migraciones y Datos Demo (Seeds)**:
   ```bash
   php artisan migrate:fresh --seed
   ```
3. **Levantar el proyecto**:
   - Con **Artisan**: Ejecute `php artisan serve` y acceda a `http://127.0.0.1:8000`

---

## 🗄️ Estructura de la BBDD

El sistema utiliza dos tablas principales:
- `clients`: Almacena la información personal de contacto.
- `vehicles`: Almacena la placa, marca, modelo y año, relacionada con un cliente (`client_id`).

### Script SQL
Se encuentra disponible un script de exportación en:
- `database/vip2cars_schema.sql` (Exportado desde MySQL)
- También puede usar las migraciones nativas en `database/migrations/`.

---

## 📏 Características Implementadas
- ✅ **CRUD Completo**: Crear, Leer, Actualizar y Eliminar.
- ✅ **Búsqueda Dinámica**: Filtre por placa, marca, modelo o nombre del cliente.
- ✅ **Validaciones Robustas**: Control de placas únicas, formatos de correo, teléfonos y años.
- ✅ **Manejo de Errores**: Mensajes de éxito y error amigables en español.
