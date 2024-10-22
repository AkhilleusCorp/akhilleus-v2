[![Codacy Badge](https://app.codacy.com/project/badge/Grade/b331de0c17654f808ff7ee4cb7957ff2)](https://app.codacy.com/gh/AkhilleusCorp/akhilleus-v2/dashboard?utm_source=gh&utm_medium=referral&utm_content=&utm_campaign=Badge_grade)
[![Codacy Badge](https://app.codacy.com/project/badge/Coverage/b331de0c17654f808ff7ee4cb7957ff2)](https://app.codacy.com/gh/AkhilleusCorp/akhilleus-v2/dashboard?utm_source=gh&utm_medium=referral&utm_content=&utm_campaign=Badge_coverage)

## Requirements
 * git
 * docker
 * node, npm, yarn (need to be moved to docker)

## Installation
 * clone the repository
 * make setup (creates local files required for applications to run)
 * make start (up containers, install symfony dependencies, create database, load fixtures)
 * yarn install (install js dependencies)
 * yarn watch (for dev)

## Backend tests
 * unit tests only: make tests_unit
 * integration tests only: make tests_integration
 * All tests + coverage: tests_all

## Frontend tests
 * to come