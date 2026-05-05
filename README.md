# geo-schema skill

Skill para Claude Code que genera schema JSON-LD (GEO/SEO semántico)
en WordPress themes custom. Se ejecuta al terminar el theme, antes del deploy.

Cubre landings de un producto y themes multipágina.
No aplica para e-commerce / WooCommerce.

---

## Instalación

En la terminal del proyecto:

```bash
mkdir -p .claude/skills/geo-schema && \
curl -L "https://raw.githubusercontent.com/bgarcias/geo-schema/main/SKILL.md" \
     -o .claude/skills/geo-schema/SKILL.md && \
curl -L "https://raw.githubusercontent.com/bgarcias/geo-schema/main/schema-engine.php" \
     -o .claude/skills/geo-schema/schema-engine.php
```

## Uso

En el chat de Claude Code:
Ejecuta el skill geo-schema. El producto es [nombre del producto].

## Archivos que genera en el theme

- `inc/schema-engine.php` — motor (copiado del skill, no se edita)
- `inc/schema-data.php` — datos específicos del producto
- `functions.php` — actualizado con el require

## Repositorio

https://github.com/bgarcias/geo-schema
