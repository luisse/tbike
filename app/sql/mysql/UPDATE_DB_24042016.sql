ALTER TABLE taxowners ADD COLUMN type character(1);
COMMENT ON COLUMN taxowners.type IS 'Type of owner driver: d user:u';

ALTER TABLE taxowners ADD COLUMN type character(1);
COMMENT ON COLUMN taxowners.type IS 'Type of owner driver: d user:u';

-- Column: floor
-- ALTER TABLE peoples DROP COLUMN floor;
ALTER TABLE peoples ADD COLUMN floor smallint;
