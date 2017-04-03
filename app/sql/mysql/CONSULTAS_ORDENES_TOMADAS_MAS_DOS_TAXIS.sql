SELECT count(*),order_id,max(driver_id),min(driver_id),min(created),max(created) 
FROM logstates WHERE reason='TOMA VIAJE' and status='En camino' GROUP BY order_id HAVING count(*) > 1 ORDER BY order_id DESC;
