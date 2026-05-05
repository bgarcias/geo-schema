# geo-schema skill

Skill para Claude Code que genera schema JSON-LD (GEO/SEO semántico)
en WordPress themes custom. Se ejecuta al terminar el theme, antes del deploy.

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
