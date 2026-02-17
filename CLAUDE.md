# CLAUDE.md — Proyecto: sesiones_claude

## Contexto del proyecto
- **Framework:** Laravel 8 (PHP)
- **Entorno:** Laragon (Windows 11)
- **Ruta:** `C:\laragon\www\sesiones_claude`
- **Bootstrap:** 5.3.3 vía CDN (en `layouts/app.blade.php`)
- **Auth:** Scaffolding de Laravel UI ya configurado

## Arquitectura actual

### Modelos
| Modelo | Tabla | Relaciones |
|--------|-------|-----------|
| `Project` | `projects` | `hasMany(Task)` |
| `Task` | `tasks` | `belongsTo(Project)` |

### Tablas
| Tabla | Columnas |
|-------|---------|
| `projects` | `id`, `name`, `description` (nullable), `deadline` (date), `timestamps` |
| `tasks` | `id`, `project_id` (FK), `title`, `description` (nullable), `priority` (enum: alta/media/baja), `status` (enum: backlog/en_progreso/testing/terminada), `timestamps` |

### Rutas protegidas (`auth`)
| Método | URI | Controlador | Nombre |
|--------|-----|-------------|--------|
| GET | `/home` | `HomeController@index` | `home` |
| GET | `/projects/create` | `ProjectController@create` | `projects.create` |
| POST | `/projects` | `ProjectController@store` | `projects.store` |
| GET | `/projects/{project}` | `ProjectController@show` | `projects.show` |
| POST | `/projects/{project}/tasks` | `TaskController@store` | `tasks.store` |
| DELETE | `/projects/{project}/tasks/{task}` | `TaskController@destroy` | `tasks.destroy` |

### Vistas
| Vista | Descripción |
|-------|-------------|
| `home.blade.php` | Dashboard con stats reales, tabla de proyectos y empty state |
| `projects/create.blade.php` | Formulario para crear proyecto |
| `projects/show.blade.php` | Detalle de proyecto + formulario y listado de tareas |
| `layouts/app.blade.php` | Layout principal con navbar y Bootstrap CDN |

---

## Backlog de peticiones

> Estado: `[ ]` Pendiente · `[~]` En progreso · `[x]` Completado
> **Prioridad:** Alta = bloqueante · Media = importante · Baja = nice-to-have
> **Dificultad:** Fácil = < 30 min · Media = horas · Difícil = días

### Prioridad Alta

| # | Petición | Dificultad | Estado | Fecha |
|---|----------|-----------|--------|-------|
| — | *Sin peticiones de alta prioridad aún* | — | — | — |

### Prioridad Media

| # | Petición | Dificultad | Estado | Fecha |
|---|----------|-----------|--------|-------|
| 1 | Crear CLAUDE.md con backlog organizado | Fácil | `[x]` | 2026-02-17 |
| 2 | Dashboard con botón a formulario de proyecto | Fácil | `[x]` | 2026-02-17 |
| 3 | Implementar Bootstrap vía CDN | Fácil | `[x]` | 2026-02-17 |
| 4 | Backend + migraciones para proyectos y tareas | Media | `[x]` | 2026-02-17 |
| 5 | Listar proyectos en /home con empty state | Fácil | `[x]` | 2026-02-17 |

### Prioridad Baja

| # | Petición | Dificultad | Estado | Fecha |
|---|----------|-----------|--------|-------|
| — | *Sin peticiones de baja prioridad aún* | — | — | — |

---

## Historial de peticiones completadas

| # | Petición | Dificultad | Fecha completado |
|---|----------|-----------|-----------------|
| 1 | Crear CLAUDE.md con backlog organizado | Fácil | 2026-02-17 |
| 2 | Dashboard básico con botón a formulario de proyecto | Fácil | 2026-02-17 |
| 3 | Rediseño del dashboard y formulario con Bootstrap 5 | Fácil | 2026-02-17 |
| 4 | Bootstrap vía CDN en layout principal | Fácil | 2026-02-17 |
| 5 | Migraciones `projects` y `tasks`, modelos con relaciones, controladores CRUD, rutas y vista show con formulario de tareas | Media | 2026-02-17 |
| 6 | Backend HomeController para obtener proyectos reales, listado con tabla y empty state en /home | Fácil | 2026-02-17 |

---

## Notas y convenciones

- Cada vez que el usuario haga una nueva petición, se añade al backlog con prioridad y dificultad.
- Al completar una tarea, se mueve al historial.
- No usar `npm run dev`; los assets se sirven vía CDN de Bootstrap.
- Los enums de `tasks.priority`: `alta`, `media`, `baja`.
- Los enums de `tasks.status`: `backlog`, `en_progreso`, `testing`, `terminada`.
