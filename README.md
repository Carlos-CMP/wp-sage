# wp-sage

Theme de WordPress ([Roots Sage 11](https://roots.io/sage/)) que implementa un catálogo de cursos: listado y ficha de curso, con materia y nivel modelados como taxonomías y precio/duración como campos ACF. Es un proyecto de práctica de un ejercicio personal de aprendizaje de WordPress, construido con las mismas convenciones que un desarrollo real.

## Stack

- WordPress + Roots Sage 11 (Blade + Acorn)
- Tailwind CSS v4, compilado con Vite
- PHP 8.2, Composer para dependencias PHP

## Contenido

- CPT `course`, registrado en PHP puro (`app/PostTypes/Course.php`)
- Taxonomías `course_subject` (jerárquica) y `course_level` (plana) (`app/Taxonomies/`)
- Campos ACF `precio` y `duracion`, registrados vía `acf_add_local_field_group()` (`app/Fields/CourseFields.php`)
- Vistas Blade: `resources/views/partials/content-course.blade.php` (listado) y `content-single-course.blade.php` (detalle), alimentadas por el View Composer `App\View\Composers\CourseMeta`

El contexto de producto (usuarios, alcance, decisiones de diseño) está en [`PRODUCT.md`](./PRODUCT.md).

## Desarrollo

```bash
composer install
npm install
npm run build   # assets de producción
npm run dev     # desarrollo con recarga en caliente
```

Requiere una instalación de WordPress con este theme activado y el plugin ACF instalado.
