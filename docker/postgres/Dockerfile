FROM postgres:15

COPY ./docker/postgres/sql /docker-entrypoint-initdb.d/

CMD ["postgres"]

EXPOSE 5432
