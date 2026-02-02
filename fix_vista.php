<?php
$f = 'c:/xampp/htdocs/OpticaHogar/vistas/vista_tipos_consulta.php';
$c = file_get_contents($f);

// 1. Technical field: types_consulta.color -> types_consulta.codigo_cups
$c = str_replace('`tipos_consulta`.`color`', '`tipos_consulta`.`codigo_cups`', $c);

// 2. Data attribute: data-color -> data-codigo_cups
$c = str_replace('data-color', 'data-codigo_cups', $c);

// 3. Row display: $registro['color'] -> $registro['codigo_cups']
$c = str_replace("\$registro['color']", "\$registro['codigo_cups']", $c);

// 4. Input name and ID: name="color" -> name="codigo_cups", id="color" -> id="codigo_cups"
$c = str_replace('name="color"', 'name="codigo_cups"', $c);
$c = str_replace('id="color"', 'id="codigo_cups"', $c);

// 5. JavaScript variables: valorcolor -> valorcodigo_cups, inputcolor -> inputcodigo_cups
$c = str_replace('valorcolor', 'valorcodigo_cups', $c);
$c = str_replace('inputcolor', 'inputcodigo_cups', $c);

// 6. Labels: color -> Código CUPS
// Be careful not to replace color in CSS variables!
// Table header label (with huge spaces)
$c = preg_replace('/>\s*color\s*<\?php/', '>                                        Código CUPS                                        <?php', $c);
// Form labels
$c = str_replace('<label for="color">color:</label>', '<label for="codigo_cups">Código CUPS:</label>', $c);

file_put_contents($f, $c);
echo "Vista actualizada correctamente.\n";
?>
