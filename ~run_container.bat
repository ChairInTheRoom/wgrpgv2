@echo Launching container...
docker volume create dbwgrpg
docker run --name=wgrpg --rm -d -p8401:80 -v dbwgrpg:/opt/lampp/var/mysql/ niwatori401/wgrpg
@echo Finished. You can play the game at: http://localhost:8401/wgrpg