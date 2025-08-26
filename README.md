# 🎬 VISOR API - Gestión de Listas de Favoritos
https://visorapi.onrender.com/api

Una API REST moderna para gestionar listas personalizadas de películas y series favoritas, desarrollada con Laravel y PostgreSQL.

## ✨ Características

🔐 **Autenticación Segura**: Sistema de tokens con Laravel Sanctum  
📝 **Gestión de Usuarios**: Registro, login y logout de usuarios  
⭐ **Listas Personalizadas**: Crear y gestionar watchlists personales  
🎬 **Películas y Series**: Soporte completo para ambos tipos de media  
📊 **Base de Datos Robusta**: PostgreSQL para almacenamiento confiable  
🐳 **Dockerizado**: Despliegue fácil en cualquier plataforma  
📱 **API RESTful**: Respuestas JSON estándar  
🚀 **Alta Performance**: Optimizado para aplicaciones web modernas  

## 🚀 Tecnologías Utilizadas

- **Laravel 12** - Framework PHP moderno y elegante
- **PHP 8.2** - Última versión estable de PHP
- **PostgreSQL** - Base de datos relacional avanzada
- **Laravel Sanctum** - Autenticación API simple y ligera
- **Docker** - Contenedorización para despliegue consistente
- **Apache** - Servidor web robusto y confiable

## 📦 Instalación

### Clona el repositorio
```bash
git clone https://github.com/Ramonmendoza13/visorApi.git
cd visorApi
```

### Instala las dependencias
```bash
composer install
```

### Configura el entorno
```bash
cp .env.example .env
php artisan key:generate
```

### Ejecuta las migraciones
```bash
php artisan migrate
php artisan db:seed
```

### Inicia el servidor
```bash
php artisan serve
```

**Abre tu navegador**: `http://localhost:8000/api`

## 🎯 Endpoints Principales

### 🔐 Autenticación
- `POST /api/register` - Registrar nuevo usuario
- `POST /api/login` - Iniciar sesión y obtener token
- `POST /api/logout` - Cerrar sesión (requiere autenticación)
- `GET /api/user` - Obtener datos del usuario autenticado

### ⭐ Gestión de Favoritos
- `GET /api/watchlists` - Obtener lista personal de favoritos
- `POST /api/watchlists` - Agregar película/serie a favoritos
- `DELETE /api/watchlists/{imdbId}` - Eliminar de favoritos
- `GET /api/watchlists/{media_type}/{imdbId}` - Obtener favorito específico

### 🛠️ Utilidades
- `GET /api/prueba` - Endpoint de prueba para verificar conectividad

## 📊 Modelo de Datos

### 👤 Users (Usuarios)
```json
{
  "id": 1,
  "name": "Usuario Demo",
  "email": "usuario@example.com",
  "email_verified_at": "2024-01-01T00:00:00Z",
  "created_at": "2024-01-01T00:00:00Z"
}
```

### ⭐ Watchlists (Favoritos)
```json
{
  "id": 1,
  "user_id": 1,
  "imdb_id": "tt1399",
  "media_type": "tv",
  "title": "Game of Thrones",
  "poster_path": "/path/to/poster.jpg",
  "created_at": "2024-01-01T00:00:00Z"
}
```

## 🎬 Funcionalidades Principales

### 🏠 Gestión de Usuarios
- **Registro Seguro**: Validación completa de datos
- **Autenticación Token**: Sistema de tokens personales
- **Perfiles Verificados**: Verificación automática de email
- **Sesiones Persistentes**: Tokens de larga duración

### ⭐ Listas Personalizadas
- **Favoritos Únicos**: Sin duplicados por usuario
- **Búsqueda Rápida**: Encuentra favoritos específicos
- **Eliminación Selectiva**: Remueve elementos individuales
- **Datos Completos**: Títulos, posters y metadatos

### 📱 Integración TMDB
- **IDs Compatibles**: Usa identificadores de TMDB/IMDB
- **Tipos de Media**: Películas (`movie`) y series (`tv`)
- **Metadatos Ricos**: Títulos y rutas de posters
- **Sincronización**: Compatible con bases de datos de cine

## 🔧 Configuración Avanzada

### Variables de Entorno
```env
# Aplicación
APP_NAME=VisorAPI
APP_ENV=production
APP_DEBUG=false
APP_URL=https://visorapi.onrender.com

# Base de Datos PostgreSQL
DB_CONNECTION=pgsql
DB_HOST=tu-host-postgresql
DB_PORT=5432
DB_DATABASE=visor_api
DB_USERNAME=tu-usuario
DB_PASSWORD=tu-password

# Autenticación
SESSION_DRIVER=database
CACHE_STORE=database
```

### Scripts Disponibles
```bash
php artisan migrate         # Ejecutar migraciones
php artisan db:seed         # Poblar base de datos
php artisan serve           # Servidor de desarrollo
php artisan config:cache    # Cachear configuración
php artisan route:cache     # Cachear rutas
```

## 🐳 Despliegue con Docker

### Construcción de la imagen
```bash
docker build -t visor-api .
```

### Ejecución del contenedor
```bash
docker run -d -p 80:80 visor-api
```

### Docker Compose (desarrollo)
```yaml
version: '3.8'
services:
  app:
    build: .
    ports:
      - "8080:80"
    environment:
      - APP_ENV=production
```

## 👤 Usuarios de Prueba

La API incluye usuarios demo listos para usar:

### Usuario 1
- **Email**: `RMC1@email.RMC`
- **Password**: `RMC1`
- **Favoritos**: Game of Thrones, Breaking Bad, The Walking Dead

### Usuario 2
- **Email**: `RMC2@email.RMC`
- **Password**: `RMC2`
- **Favoritos**: Stranger Things, Cars, Los Soprano

## 🌟 Ejemplos de Uso

### Registro de Usuario
```bash
curl -X POST https://visorapi.onrender.com/api/register \
  -H "Content-Type: application/json" \
  -d '{
    "name": "Mi Nombre",
    "email": "mi@email.com",
    "password": "mipassword123"
  }'
```

### Iniciar Sesión
```bash
curl -X POST https://visorapi.onrender.com/api/login \
  -H "Content-Type: application/json" \
  -d '{
    "email": "mi@email.com",
    "password": "mipassword123"
  }'
```

### Agregar a Favoritos
```bash
curl -X POST https://visorapi.onrender.com/api/watchlists \
  -H "Authorization: Bearer TU_TOKEN_AQUI" \
  -H "Content-Type: application/json" \
  -d '{
    "imdb_id": "tt0944947",
    "media_type": "tv",
    "title": "Game of Thrones",
    "poster_path": "/path/to/poster.jpg"
  }'
```

### Obtener Favoritos
```bash
curl -X GET https://visorapi.onrender.com/api/watchlists \
  -H "Authorization: Bearer TU_TOKEN_AQUI"
```

## 📁 Estructura del Proyecto

```
visorApi/
├── app/
│   ├── Http/Controllers/          # Controladores de la API
│   │   ├── ApiController.php      # Gestión de watchlists
│   │   └── LoginController.php    # Autenticación y usuarios
│   └── Models/                    # Modelos Eloquent
│       ├── User.php              # Modelo de usuario
│       └── Watchlist.php         # Modelo de favoritos
├── database/
│   ├── migrations/               # Migraciones de base de datos
│   └── seeders/                 # Datos de prueba
│       └── DatabaseSeeder.php   # Seeder principal
├── routes/
│   └── api.php                  # Definición de rutas API
├── docker/                      # Configuraciones Docker
├── Dockerfile                   # Imagen de contenedor
└── README.md                    # Documentación
```

## 🚀 Despliegue en Producción

La aplicación está optimizada para desplegarse en:

- ✅ **Render** - Despliegue automático desde GitHub
- ✅ **Railway** - Plataforma moderna de despliegue
- ✅ **Heroku** - Plataforma tradicional confiable
- ✅ **DigitalOcean** - App Platform escalable
- ✅ **AWS** - Servicios empresariales
- ✅ **Google Cloud** - Infraestructura robusta

### URL de Producción
🌐 **API Base**: `https://visorapi.onrender.com/api`

## 🤝 Contribuir

1. **Fork** el proyecto
2. Crea una **rama** para tu feature (`git checkout -b feature/NuevaFuncionalidad`)
3. **Commit** tus cambios (`git commit -m 'Agregar nueva funcionalidad'`)
4. **Push** a la rama (`git push origin feature/NuevaFuncionalidad`)
5. Abre un **Pull Request**

## 📄 Licencia

Este proyecto está bajo la **Licencia MIT**. Ver el archivo `LICENSE` para más detalles.

## 👨‍💻 Autor

**Ramón Mendoza Candelario**

- 💼 **LinkedIn**: [Ramón Mendoza](https://linkedin.com/in/ramonmendoza13)
- 🌐 **Portfolio**: [Portfolio](https://ramonmendoza13.github.io)
- 🐙 **GitHub**: [@ramonmendoza13](https://github.com/ramonmendoza13)
- 📧 **Email**: ramonmendoza.dev@gmail.com

## 🙏 Agradecimientos

- **Laravel Team** por el framework excepcional
- **PostgreSQL** por la base de datos robusta
- **Docker** por la contenedorización simplificada
- **Render** por el hosting gratuito confiable
- **TMDB** por inspirar la estructura de datos

---

## 🎬 VISOR API - Tu gestor personal de favoritos

⭐ **¡Dale una estrella si te gusta el proyecto!**

🔗 **Conecta con el