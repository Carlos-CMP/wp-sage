# Product

<!-- impeccable:product-schema 1 -->

## Platform

web

## Users

Alumno potencial que explora la oferta formativa: navega el listado de cursos, filtra mentalmente por materia (`course_subject`) y nivel (`course_level`), y entra al detalle de un curso concreto para decidir si le interesa.

## Product Purpose

Catálogo de cursos (listado + detalle) de un centro de formación, que permite al visitante ver de un vistazo materia, nivel, duración y precio de cada curso, y actuar (inscribirse/solicitar información) sobre el que le interese. Proyecto de práctica de aprendizaje, no un producto de cliente real, pero diseñado y construido como si lo fuera.

## Positioning

No aplica una posición de mercado real: es un proyecto de práctica sin competencia ni cliente real. Se modela como el catálogo de un centro de formación genérico, diferenciado por mostrar de forma transparente precio y duración por curso ya en el listado, no solo en el detalle.

## Operating Context

- Stack: WordPress + Roots Sage 11 (Blade + Acorn), Tailwind CSS v4 (solo Preflight importado, sin diseño propio todavía), PHP 8.2.
- Contenido gestionado por un editor vía `wp-admin`: CPT `course`, taxonomías `course_subject` (jerárquica) y `course_level` (plana), campos ACF `precio`/`duracion` (registrados en PHP, no editables desde la UI de ACF).
- Entorno local: sitio Local `wp-sage-test` (`http://localhost:10016`).

## Capabilities and Constraints

- CPT `course` + taxonomías `course_subject`/`course_level` y Field Group ACF (`precio`/`duracion`) ya registrados en PHP puro (`app/Base/CPT.php`, `app/Base/Taxonomy.php`, `app/Fields/CourseFields.php`) — estructura de datos fija, no rediseñar el modelo de contenido en trabajo de diseño.
- El CTA de inscripción/contacto es únicamente de interfaz: no existe backend real de inscripción ni formulario funcional detrás. Se diseña como si existiera, sin inventar lógica de envío/confirmación real.
- Vistas actuales: `partials/content-single-course.blade.php` (detalle) y `partials/content-course.blade.php` (tarjeta de listado), con datos inyectados vía el View Composer `CourseMeta` (`duracion`, `precio` ya formateado).

## Brand Commitments

El usuario ha pedido inspirarse en la identidad de Novicell (agencia real) como referencia de marca para este ejercicio, aunque el sitio no es un entregable de cliente.

**Preferencia fija de dirección visual (2026-08-05):** el usuario probó un mundo temático completo ("escritorio de un bit", elegido como challenger sobre la dirección asignada por el roll de `new-work`) y pidió deshacerlo por uno más neutral. Preferencia confirmada: estrategia de color **Restrained** (neutros + un único acento), sin mundo temático/metáfora. Esto es la salida estándar ("standing exit"/canon) de `new-work.md`, no un mundo a sortear: en próximas pasadas de diseño sobre este proyecto, partir directamente de esta dirección neutra en vez de repetir la ceremonia completa de 7 candidatos + `concept-seed.mjs`, salvo que el usuario pida explícitamente explorar un mundo temático de nuevo.

## Evidence on Hand

3 cursos de prueba sembrados: Excel Avanzado, Introducción a la Programación, Diseño Gráfico Básico, con jerarquía real en `course_subject` (Programación como hijo de Informática). No hay más contenido, testimonios, ni precios reales más allá de estos — no fabricar cursos ni evidencia adicional sin pedirlo.

## Product Principles

1. Transparencia de datos: precio, duración, materia y nivel visibles de un vistazo, tanto en listado como en detalle.
2. Camino claro a la conversión: cada curso ofrece una acción de inscripción/contacto sin fricción, aunque sea solo de interfaz.
3. Estructura editorial mantenible: alta de cursos vía `wp-admin`/ACF sin tocar código.
4. Coherencia visual entre listado y detalle: mismo lenguaje y jerarquía de datos en ambas vistas.
