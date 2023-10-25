docker volume create dbwgrpg
docker run --name=wgrpg --rm -p8401:80 -v dbwgrpg:/opt/lampp/var/mysql/ niwatori401/wgrpg