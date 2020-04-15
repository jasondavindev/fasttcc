function db_setup {
  docker exec -ti fasttcc_db /bin/sh -c 'mysql fasttcc </var/lib/mysql/script.sql'
}

function dkupd {
  docker-compose up -d
  exitcode=$?
  return $exitcode
}

function dkupa {
  docker-compose up
  exitcode=$?
  return $exitcode
}

function dk {
  docker-compose run --rm app $@
  exitcode=$?
  return $exitcode
}

function dkdown {
  docker-compose down
  exitcode=$?
  return $exitcode
}