# Framework

This is the repository for the course Object-oriented web technologies (DV1608) at Blekinge Institute of Technology.

![badge](https://scrutinizer-ci.com/g/pereriksson/framework/badges/quality-score.png?b=master "badge")
![badge](https://scrutinizer-ci.com/g/pereriksson/framework/badges/coverage.png?b=master "badge")
![badge](https://scrutinizer-ci.com/g/pereriksson/framework/badges/build.png?b=master "badge")

## Using Doctrine

```shell
doctrine:migrations:current                [current] Outputs the current version
doctrine:migrations:diff                   [diff] Generate a migration by comparing your current database to your mapping information.
doctrine:migrations:dump-schema            [dump-schema] Dump the schema for your database to a migration.
doctrine:migrations:execute                [execute] Execute one or more migration versions up or down manually.
doctrine:migrations:generate               [generate] Generate a blank migration class.
doctrine:migrations:latest                 [latest] Outputs the latest version
doctrine:migrations:list                   [list-migrations] Display a list of all available migrations and their status.
doctrine:migrations:migrate                [migrate] Execute a migration to a specified version or the latest available version.
doctrine:migrations:rollup                 [rollup] Rollup migrations by deleting all tracked versions and insert the one version that exists.
```
