# 📝 Notas App — CRUD de Apuntes con Laravel 13

<p align="center">
  <img src="/public/images/banner.svg" alt="Notas App Banner" width="100%">
</p>

<p align="center">

![Laravel](https://img.shields.io/badge/Laravel-13-red?style=for-the-badge&logo=laravel)
![PHP](https://img.shields.io/badge/PHP-8.5-blue?style=for-the-badge&logo=php)
![PostgreSQL](https://img.shields.io/badge/PostgreSQL-17-blue?style=for-the-badge&logo=postgresql)
![TailwindCSS](https://img.shields.io/badge/TailwindCSS-4-38BDF8?style=for-the-badge&logo=tailwindcss)

</p>

---

# 📚 Descripción del Proyecto

**Notas App** es una aplicación web desarrollada con Laravel 13 que permite gestionar apuntes y recordatorios personales mediante operaciones CRUD completas.

La aplicación fue desarrollada como parte de la materia:

> **INF560 — Desarrollo Web Backend**  
> Universidad Autónoma Tomás Frías

---

# 📸 Capturas del Proyecto

## 🏠 Vista Principal


![Home](/public/images/home.png)


---

## 📝 Mostrar Nota


![Create](/public/images/show.png)


---

## ➕ Crear Nota


![Create](/public/images/create.png)


---

## ✏️ Editar Nota


![Edit](/public/images/edit.png)


---

## 🔍 Buscador


![Search](/public/images/search.png)


---

## ⚠️ Validaciones


![Validation](/public/images/validation.png)


---

# ✨ Características Principales

✅ Crear notas  
✅ Editar notas  
✅ Eliminar notas  
✅ Ver detalles de notas  
✅ Fijar / desfijar notas importantes  
✅ Buscador dinámico  
✅ Validación del lado del servidor  
✅ Mensajes flash interactivos  
✅ Diseño moderno con TailwindCSS  
✅ Mascota interactiva 🐱  
✅ Factory y Seeder para datos de prueba  
✅ Arquitectura MVC con Laravel

---

# 🧠 Tecnologías Utilizadas

| Tecnología | Uso |
|---|---|
| Laravel 13 | Framework backend |
| PHP 8.5 | Lenguaje principal |
| PostgreSQL | Base de datos |
| TailwindCSS | Estilos y diseño |
| Blade | Motor de plantillas |
| Git y GitHub | Control de versiones |

---

# 🏗️ Arquitectura del Proyecto

```txt
notas-app
│
├── app
│   ├── Http
│   │   ├── Controllers
│   │   └── Requests
│   └── Models
│
├── database
│   ├── factories
│   ├── migrations
│   └── seeders
│
├── resources
│   └── views
│       ├── layouts
│       └── notas
│
├── routes
│
└── public
```

---

# 🗄️ Modelo de Base de Datos

```txt
┌─────────────────────────┐
│         notas           │
├─────────────────────────┤
│ id            BIGINT PK │
│ titulo        VARCHAR   │
│ contenido     TEXT      │
│ categoria     VARCHAR   │
│ fijada        BOOLEAN   │
│ created_at    TIMESTAMP │
│ updated_at    TIMESTAMP │
└─────────────────────────┘
```

---

# 🚀 Instalación del Proyecto

## 1️⃣ Clonar el repositorio

```bash
git clone https://github.com/TU-USUARIO/notas-app.git
```

---

## 2️⃣ Entrar al proyecto

```bash
cd notas-app
```

---

## 3️⃣ Instalar dependencias

```bash
composer install
```

---

## 4️⃣ Configurar variables de entorno

```bash
cp .env.example .env
```

---

## 5️⃣ Generar clave de aplicación

```bash
php artisan key:generate
```

---

## 6️⃣ Configurar la base de datos

Editar el archivo `.env`

```env
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=notas_app
DB_USERNAME=postgres
DB_PASSWORD=tu_password
```

---

## 7️⃣ Ejecutar migraciones y seeders

```bash
php artisan migrate:fresh --seed
```

---

## 8️⃣ Iniciar servidor

```bash
php artisan serve
```

---


# 🔥 Funcionalidades Destacadas

## 📌 Sistema de Notas Fijadas

Las notas importantes pueden fijarse para aparecer primero en la lista principal.

---

## 🔎 Buscador Inteligente

El sistema permite buscar notas por:

- título
- contenido
- categoría

---

## 🐱 Mascota Interactiva

La aplicación incorpora una mascota virtual que mejora la experiencia del usuario mediante mensajes dinámicos e interacción visual.

---

# 🧪 Datos de Prueba

La aplicación utiliza:

- Factories
- Seeders

para generar notas automáticamente y facilitar pruebas del sistema.

---

# 🛡️ Validaciones Implementadas

✔️ Título obligatorio  
✔️ Máximo 120 caracteres  
✔️ Categorías válidas  
✔️ Validación backend  
✔️ Protección CSRF  
✔️ Confirmación antes de eliminar

---

# 📌 Rutas Principales

| Método | Ruta | Descripción |
|---|---|---|
| GET | `/notas` | Listar notas |
| GET | `/notas/create` | Crear nota |
| POST | `/notas` | Guardar nota |
| GET | `/notas/{nota}` | Ver detalle |
| GET | `/notas/{nota}/edit` | Editar nota |
| PUT | `/notas/{nota}` | Actualizar nota |
| DELETE | `/notas/{nota}` | Eliminar nota |

---

# 👨‍💻 Autor

**Abdair Coca**  
Estudiante de Ingeniería Informática — UATF

---

# 📖 Aprendizajes Obtenidos

Durante el desarrollo de este proyecto se fortalecieron conocimientos sobre:

- Arquitectura MVC
- CRUD completo
- Laravel 13
- Eloquent ORM
- Validaciones
- Blade Templates
- TailwindCSS
- PostgreSQL
- Buenas prácticas backend

---

# ⭐ Conclusión

Este proyecto permitió implementar una aplicación web funcional aplicando correctamente el patrón CRUD mediante Laravel, reforzando conceptos fundamentales del desarrollo backend moderno y mejorando la experiencia de usuario mediante una interfaz moderna e interactiva.