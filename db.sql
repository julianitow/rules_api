CREATE DATABASE rule_api;

CREATE USER 'rule_api'@'%' IDENTIFIED BY 'rule_api';

GRANT ALL PRIVILEGES ON rule_api.* TO 'rule_api'@'%';

FLUSH PRIVILEGES;

