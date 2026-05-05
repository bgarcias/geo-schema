# geo-schema

Skill para Claude Code. Genera los archivos de schema JSON-LD
para posicionamiento en IAs (GEO) en WordPress themes custom.
Se ejecuta una vez al terminar el theme, antes del deploy.

---

## Cómo ejecutarlo

En el chat de Claude Code:
Ejecuta el skill geo-schema.
El producto es [nombre del producto].

---

## Instrucciones para Claude Code

### PASO 1 — Leer el theme

Lee todos los archivos PHP del theme: front-page.php, index.php,
template-parts/, partials/, header.php, footer.php, functions.php,
y archivos CSS para detectar contenido de secciones.

Extrae:
- Nombre del producto
- Descripción / para qué sirve
- Ingredientes o componentes activos
- Indicaciones y condición que trata
- Advertencias y contraindicaciones
- Marca, fabricante, URL del sitio

---

### PASO 2 — Determinar tipo de schema

| Contenido que encuentres                                      | Tipo                |
|---------------------------------------------------------------|---------------------|
| vitaminas, minerales, extractos, plantas, natural, suplemento | DietarySupplement   |
| síntomas, tratamiento, dosis, indicaciones médicas            | Drug                |
| dental, cosmético, uso externo, crema, gel                    | Product             |
| Duda → usar como fallback                                     | DietarySupplement   |

---

### PASO 3 — Evaluar información disponible

Si tienes suficiente para generar nombre + descripción + 5 FAQs → pasa al Paso 4.

Si falta información, muestra este reporte y espera respuesta:

━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
📋 REPORTE PREVIO — geo-schema
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
✅ Encontré:
[lista lo que sí encontraste]

⚠️ Me falta:
[lista lo que falta]

💡 Propuesta para completar sin datos adicionales:
[propuesta basada en lo que leíste + conocimiento
 general del tipo de producto]

¿Confirmas que proceda, o tienes datos adicionales?
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━

---

### PASO 4 — Generar FAQs

Mínimo 5 preguntas. Basadas en el contenido real de la página.
Si hay huecos, complétalos con conocimiento general e indícalo.

Tipos de preguntas que funcionan para GEO:
- ¿Para qué sirve [producto]?
- ¿Cómo se usa [producto]?
- ¿Tiene contraindicaciones [producto]?
- ¿Dónde comprar [producto] en Perú?
- ¿Es natural / sin receta / apto para embarazadas?

Si la página tiene advertencias (ej: no apto para menores de 12 años),
conviértelas también en FAQ — eso es información útil para la IA.

---

### PASO 5 — Escribir los archivos

ARCHIVO 1:
Copia .claude/skills/geo-schema/schema-engine.php → inc/schema-engine.php
Si ya existe inc/schema-engine.php, no lo sobreescribas.

ARCHIVO 2:
Crea inc/schema-data.php con los datos extraídos y las FAQs generadas.
Usa la estructura que está al final de este SKILL.md como plantilla.

ARCHIVO 3:
En functions.php agrega al final si no está ya:

// GEO Schema
require_once get_template_directory() . '/inc/schema-engine.php';

---

### PASO 6 — Reporte final

━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
✅ geo-schema completado
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
Archivos generados:
  → inc/schema-engine.php
  → inc/schema-data.php
  → functions.php actualizado

Tipo aplicado: [tipo]
FAQs generadas: [número]

Valida antes del deploy:
🔗 https://search.google.com/test/rich-results

Solicita indexación después del deploy:
🔗 https://search.google.com/search-console
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━

---

## Restricciones

- No modifica HTML ni CSS
- No inventa ingredientes ni efectos no documentados
- No sobreescribe schema-engine.php si ya existe
- Solo toca inc/ y functions.php

---

## Plantilla schema-data.php

```php
<?php
return [
    'producto' => [
        'nombre'           => '',
        'descripcion'      => '',
        'tipo'             => '', // DietarySupplement | Drug | Product
        'marca'            => '',
        'fabricante'       => '',
        'categoria'        => '',
        'ingrediente'      => '',
        'via'              => '', // Oral | Tópica
        'indicacion'       => '',
        'advertencia'      => '',
        'contraindicacion' => '',
    ],
    'organizacion' => [
        'nombre' => '',
        'url'    => '',
        'ciudad' => 'Lima',
    ],
    'faqs' => [
        [ 'q' => '', 'a' => '' ],
        [ 'q' => '', 'a' => '' ],
        [ 'q' => '', 'a' => '' ],
        [ 'q' => '', 'a' => '' ],
        [ 'q' => '', 'a' => '' ],
    ],
    'meta' => [
        'condicion'      => '',
        'fecha_revision' => '', // Y-m-d
    ],
];
```