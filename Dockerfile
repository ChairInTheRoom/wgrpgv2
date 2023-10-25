FROM ubuntu:22.04
RUN apt-get update && apt-get upgrade
RUN apt-get install -y curl git net-tools
WORKDIR /app
RUN curl -L https://sourceforge.net/projects/xampp/files/XAMPP%20Linux/8.2.4/xampp-linux-x64-8.2.4-0-installer.run/download > installer.run
RUN chmod +x installer.run
RUN ./installer.run --mode unattended
RUN git clone https://github.com/Niwatori401/wgrpgv2.git
RUN mv wgrpgv2/ /opt/lampp/htdocs/wgrpg
WORKDIR /opt/lampp
COPY httpd-xampp.conf etc/extra/httpd-xampp.conf
RUN ./lampp startmysql && sleep 10 && /opt/lampp/bin/mysql -u root -e "CREATE DATABASE dbwgrpg" && /opt/lampp/bin/mysql -u root dbwgrpg < /opt/lampp/htdocs/wgrpg/SQL/dbwgrpg.sql && ./lampp stopmysql
WORKDIR /app
COPY startserver.sh .
RUN chmod +x startserver.sh
ENTRYPOINT ["./startserver.sh"]
