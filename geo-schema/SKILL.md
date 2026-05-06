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
- Nombre del producto y para qué sirve
- Condición médica que trata
- Advertencias y contraindicaciones
- Marca, fabricante, URL del sitio

---

### PASO 2 — OBLIGATORIO: Mostrar reporte y esperar confirmación

**STOP. Antes de escribir cualquier archivo, muestra este reporte y espera respuesta.**
Este paso es siempre obligatorio, sin excepción.

━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
📋 REPORTE PREVIO — geo-schema
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
✅ Información extraída del theme:
[lista todo lo que encontraste]

📝 FAQs que propongo incluir:
1. Q: [pregunta] / A: [respuesta]
2. Q: [pregunta] / A: [respuesta]
3. Q: [pregunta] / A: [respuesta]
4. Q: [pregunta] / A: [respuesta]
5. Q: [pregunta] / A: [respuesta]
[más si aplica]

⚠️ Información que no encontré / asumí:
[lista lo que completaste con conocimiento general]

❓ ¿Procedo con esto o tienes correcciones?
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━

**No escribas ningún archivo hasta recibir confirmación explícita.**

---

### PASO 3 — Generar FAQs

Mínimo 5 preguntas basadas en el contenido real de la página.
Si hay huecos, complétalos con conocimiento general e indícalo.

Tipos de preguntas que funcionan para GEO:
- ¿Para qué sirve [producto]?
- ¿Cómo se usa [producto]?
- ¿Tiene contraindicaciones [producto]?
- ¿Dónde comprar [producto] en Perú?
- ¿Es natural / sin receta / apto para embarazadas?

Si la página tiene advertencias, conviértelas también en FAQ.

---

### PASO 4 — Escribir los archivos

ARCHIVO 1:
Copia .claude/skills/geo-schema/schema-engine.php → inc/schema-engine.php
Si ya existe inc/schema-engine.php, no lo sobreescribas.

ARCHIVO 2:
Crea inc/schema-data.php con los datos extraídos y las FAQs generadas.
Usa la plantilla al final de este SKILL.md.

ARCHIVO 3:
En functions.php agrega al final si no está ya:

// GEO Schema
require_once get_template_directory() . '/inc/schema-engine.php';

---

### PASO 5 — Reporte final

━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
✅ geo-schema completado
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
Archivos generados:
  → inc/schema-engine.php
  → inc/schema-data.php
  → functions.php actualizado

FAQs generadas: [número]

Valida antes del deploy:
🔗 https://search.google.com/test/rich-results

Solicita indexación después del deploy:
🔗 https://search.google.com/search-console
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━

---

## Restricciones

- No agregar `offers`, `review` ni `aggregateRating`
- No usar tipos Drug, DietarySupplement ni Product — generan errores en Google
- No modificar HTML ni CSS
- No inventar ingredientes ni efectos no documentados
- No sobreescribir schema-engine.php si ya existe
- Solo tocar inc/ y functions.php

---

## Plantilla schema-data.php

```php
<?php
return [
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
