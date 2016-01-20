#!/usr/bin/env bash

bin/console doctrine:database:drop --force;

if [ ! -d "web/uploads/" ]; then
  mkdir web/uploads
fi
cp web/fixtures/* web/uploads/;

bin/console doctrine:database:create;
bin/console doctrine:schema:update --force;

bin/console doctrine:fixtures:load --no-interaction;