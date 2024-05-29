# to view if container has an restart policy
docker inspect my-container-name | grep RestartPolicy -A 3

# to stop container run automatically when docker has been started
docker update --restart=no my-container-name

# to view directory in docker container
docker container exec -i -t my-container-name /bin/sh

# to start docker compose
docker compose up -d

# to build without caching
docker compose --build -d