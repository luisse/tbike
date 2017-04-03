pg_dump -U admintaxiar -h dev-db.taxiar.com.ar taxiar > pgtaxiar.sql
psql -U admintaxiar -h dev-db.taxiar.com.ar taxiar -f export_test.sql > result_export.log
