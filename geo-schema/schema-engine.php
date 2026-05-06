<?php
/**
 * Schema Engine — Motor GEO/JSON-LD
 * No editar. Los datos van en inc/schema-data.php
 */

function geo_schema_inyectar($data)
{
    $schemas = [];
    $o    = $data['organizacion'] ?? [];
    $faqs = $data['faqs']         ?? [];
    $meta = $data['meta']         ?? [];

    // 1. Organización
    if (!empty($o['nombre'])) {
        $schemas[] = [
            '@context' => 'https://schema.org',
            '@type'    => 'Organization',
            'name'     => $o['nombre'],
            'url'      => $o['url'] ?? '',
            'address'  => [
                '@type'           => 'PostalAddress',
                'addressCountry'  => 'PE',
                'addressLocality' => $o['ciudad'] ?? 'Lima',
            ],
        ];
    }

    // 2. FAQPage
    if (!empty($faqs)) {
        $schemas[] = [
            '@context'   => 'https://schema.org',
            '@type'      => 'FAQPage',
            'mainEntity' => array_map(fn($f) => [
                '@type'          => 'Question',
                'name'           => $f['q'],
                'acceptedAnswer' => ['@type' => 'Answer', 'text' => $f['a']],
            ], $faqs),
        ];
    }

    // 3. MedicalWebPage
    if (!empty($meta['condicion'])) {
        $schemas[] = [
            '@context'     => 'https://schema.org',
            '@type'        => 'MedicalWebPage',
            'about'        => ['@type' => 'MedicalCondition', 'name' => $meta['condicion']],
            'audience'     => 'https://schema.org/Patient',
            'lastReviewed' => $meta['fecha_revision'] ?? date('Y-m-d'),
            'inLanguage'   => 'es-PE',
        ];
    }

    add_action('wp_head', function () use ($schemas) {
        foreach ($schemas as $schema) {
            echo "\n<script type=\"application/ld+json\">\n";
            echo wp_json_encode(
                $schema,
                JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT
            );
            echo "\n</script>\n";
        }
    });
}

$_geo_data = require get_template_directory() . '/inc/schema-data.php';
geo_schema_inyectar($_geo_data);
