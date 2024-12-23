# gfmodules-mcsd-consumer-web-private

A web application to efficiently view supplier FHIR resources and manage the counter part from consumer. This application includes the following features:

- Screen to manage suppliers (add/update/delete)
- Screen to perform updates on resources and display the resource map
- Screen to view consumer resources
- Screen to compare the history of a resource

## Requirements

- <https://github.com/minvws/gfmodules-mcsd-consumer-private> running in a docker container
- Php 8.2
- [nodejs](https://nodejs.org/en/download/package-manager)

> **Note:** Nodejs needs a github read package token to install the private packages. This can be done manually or the installation script will guide you through this process as well.

## Setup & Install

1. make setup
2. make run

Or start it in a docker container (This is only possible if the .npmrc file has been created with the correct access token):

```bash
docker compose up --build --remove-orphans
```

The frontend is also automatically started when using the [gfmodules-coordination](https://github.com/minvws/gfmodules-coordination-private) setup script.
