# Espera... ¿JS y PHP? ¿Cómo es eso?

> Note: This documentation is translated to english: [> See it in english](https://github.com/fadrian06/JSPHP/blob/docs/README.md)

📚 JSPHP es una poderosa biblioteca de PHP que provee un conjunto de clases diseñadas
para imitar el comportamiento de **las clases de los primitivos en JavaScript** como
Number, String y más.

🎯 Con JSPHP, los desarrolladores en PHP pueden familirializarse con conceptos de
JavaScript y sus funcionalidades en sus proyectos de PHP. 🌈

Esta biblioteca apunta a ser un puente entre JavaScript y PHP, permitiéndoles a los
desarrolladores escribir código más limpio y más eficiente.

> **✨ Sin importar si eres un desarrollador en PHP que busca explorar características**
> **parecidas a las de JavaScript o un desarrollador en JavaScript trabajando con**
> **PHP, JSPHP es la herramienta perfecta para mejorar tu experiencia de desarrollo. 💪**
>
> **¡Dale a tus proyectos de PHP un toque de JavaScript con JSPHP! 🚀**

## Requisitos

- [PHP version 7 o superior](https://php.net)

## Instalación

🚀 ¡Empezar a usar JSPHP es super fácil! Sólo sigue estos simples pasos:

**1- Primero, instala JSPHP usando composer:**
```bash
composer require faslatam/jsphp
```

**2. Incluye el autocargador de composer:**
```php
<?php

require '/path/to/vendor/autoload.php';

# Finalmente, ¡ya está! :D. Puedes ahora empezar a usar JSPHP en tus proyectos.

$nombre = String('foo');
echo $nombre->toUpperCase(); # Salida: FOO

$usuario = JSON::parse('{ "id": 1, "nombre": "foo" }');
echo $usuario->nombre; # Salida: foo

$colores = JSArray(['rojo', 'púrpura', 'negro']);
$colores->forEach(function (?string $color): void {
  echo "Me gusta el color $color\n";
});

echo "\ncolores = $colores";

/* Output:
----------
Me gusta el color rojo
Me gusta el color púrpura
Me gusta el color negro

colores = rojo,púrpura,negro
 */
```

## Componentes

JSPHP está dividido en componentes que son equivalentes a clases de JS. Algunos
componentes están en desarrollo, siéntete libre de contribuir añadiendo
funcionalidades extras.

> [> Ver documentación](https://fadrian06.github.io/JSPHP/)

| Componente                                                              | Estado                   |
|-------------------------------------------------------------------------|--------------------------|
| [JSON](https://fadrian06.github.io/JSPHP/classes/JSON.html)             | ℹ️ _(en desarrollo)_     |
| [Math](https://fadrian06.github.io/JSPHP/classes/Math.html)             | ℹ️ _(en desarrollo)_     |
| [JSString](https://fadrian06.github.io/JSPHP/classes/JSString.html)     | ℹ️ _(en desarrollo)_     |
| [JSNumber]()                                                            | ❌ _(no implementado)_   |
| [JSArray]()                                                             | ℹ️ _(en desarrollo)_     |
| [JSObject]()                                                            | ❌ _(no implementado)_   |
| [undefined](https://fadrian06.github.io/JSPHP/files/src-undefined.html) | ✅ _(terminado)_         |
