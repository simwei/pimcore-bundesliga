# Pimcore Bundesliga

Introductory project for Pimcore. Contains:

-   overview page at `/teams`
-   team details pages at `/team/{{name}}`

Built with:

-   Pimcore
    -   Data Importer
-   MDBootstrap

## Local Setup Instructions (with Docker)

-   Clone the repo

-   Setup the docker containers:

    ```bash
    docker compose up -d
    docker compose exec php composer install
    docker compose exec php vendor/bin/pimcore-install --mysql-host-socket=db --mysql-database=pimcore
    docker compose exec php bin/console pimcore:bundle:install PimcoreDataHubBundle
    docker compose exec php bin/console pimcore:bundle:install PimcoreDataImporterBundle
    ```

-   Import team data:

    ```bash
    curl --location 'http://localhost/pimcore-datahub-import/TeamsImport/push' --header 'Authorization: Bearer 7003910d30445c3d27e0e7419c485d4d' --data-binary '@bundesliga.xlsx' -X POST

    docker compose exec php bin/console datahub:data-importer:process-queue-parallel
    ```

-   Import player data:

    ```bash
    curl --location 'http://localhost/pimcore-datahub-import/PlayersImport/push' --header 'Authorization: Bearer 7003910d30445c3d27e0e7419c485d4d' --data-binary '@bundesliga.xlsx' -X POST

    docker compose exec php bin/console datahub:data-importer:process-queue-parallel
    ```

-   Open http://localhost/teams
