# env-var-extension

This library provides methods to use environment variables in Twig templates.

## Installation

```
composer require oskarstark/env-var-extension
```

```yaml
# config/services.yaml
services:
    OskarStark\Twig\EnvVarExtension:
        tags: ['twig.extension']
```

## Usage

To access the value of an existing environment variable ``BRANCH_NAME=develop``
```twig
{{ env(BRANCH_NAME) }} # prints 'develop'
```

You can also check if an envirnment variable exists:
```twig
{{ has_env(BRANCH_NAME) }} # prints 'true'
```
