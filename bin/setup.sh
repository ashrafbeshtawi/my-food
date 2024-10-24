#!/bin/bash

# Check if .env file doesn't exist
if [ ! -f .env ]; then
    # If it doesn't exist, copy .env-example to .env
    cp .env-example .env
    echo ".env file created from .env-example"
else
    echo ".env file already exists, skipping copy"
fi

# Run docker-compose up in detached mode
docker-compose up -d