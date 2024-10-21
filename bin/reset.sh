#!/bin/bash

# Shut down the containers
docker-compose down

# Define the folders to remove
folders=(
    "symfony/vendor"
    "symfony/var"
)

# Loop through the folders
for folder in "${folders[@]}"; do
    if [ -d "$folder" ]; then
        echo "Removing $folder..."
        rm -rf "$folder"
        echo "$folder removed successfully."
    else
        echo "$folder does not exist. Skipping..."
    fi
done

echo "Cleanup complete."