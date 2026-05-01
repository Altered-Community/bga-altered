# Code rules & naming conventions

## PHP Standards Recommendations
We use basic PHP conventions: [PHP Standards Recommendations](https://www.php-fig.org/psr/)

It's a convention that we must follow for all coding the same way.
We can add tools to our project in our IDE to auto-correct us.
- https://cs.symfony.com/

### What's PHP Standards Recommendations

It's a set of rules to follow; here are the two most important ones.

- ➡️ [Basic Coding Standard](https://www.php-fig.org/psr/psr-1/) ⬅️
- ➡️ [Extended Coding Style Guide](https://www.php-fig.org/psr/psr-12/) ⬅️

There is a recap of the basic rules below but for the extended on I'll let you go on the documentation

#### Most important Basics
- PHP code MUST use the long `<?php ?>` tags or the short-echo `<?= ?>` tags; it MUST NOT use the other tag variations.
- PHP code MUST use only UTF-8 without BOM.
- Files SHOULD either declare symbols (classes, functions, constants, etc.) or cause side-effects (e.g. generate output, change .ini settings, etc.) but SHOULD NOT do both. ([documentation](https://www.php-fig.org/psr/psr-1/#23-side-effects))
- Class names MUST be declared in `StudlyCaps`, `PascalCase` (where the first letter of each word is capitalized including the very first letter.).  ([documentation](https://www.php-fig.org/psr/psr-1/#3-namespace-and-class-names))
- Class constants MUST be declared in all upper case with underscore separators. ([documentation](https://www.php-fig.org/psr/psr-1/#41-constants))
- Method names MUST be declared in `camelCase`. ([documentation](https://www.php-fig.org/psr/psr-1/#42-properties))

## QUESTIONS
⚠️ We need Vincent to help us with all the abbreviations here!

some variables use abbreviations like:
- `ctx` maybe context is it like a node from the Tree Engine?

Functions have 3 prefixes what do they mean?
- `act` : 
- `args`: 
- `st`  : 

## Navigation
[< Back to main](../README.md)
