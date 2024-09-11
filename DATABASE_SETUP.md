# Database Setup Instructions

On an empty database, import the `bundesliga.xlsx` Excel file.

## Import team data

```bash
curl --location 'http://localhost/pimcore-datahub-import/TeamsImport/push' --header 'Authorization: Bearer 7003910d30445c3d27e0e7419c485d4d' --data-binary '@bundesliga.xlsx' -X POST
```

## Trigger processing for team data

```bash
bin/console datahub:data-importer:process-queue-parallel
```

## Import player data

```bash
curl --location 'http://localhost/pimcore-datahub-import/PlayersImport/push' --header 'Authorization: Bearer 7003910d30445c3d27e0e7419c485d4d' --data-binary '@bundesliga.xlsx' -X POST
```

## Trigger processing again

```bash
bin/console datahub:data-importer:process-queue-parallel
```
