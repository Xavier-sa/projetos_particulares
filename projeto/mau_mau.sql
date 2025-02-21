CREATE DATABASE mau_mau;



USE mau_mau;

CREATE TABLE users (
    id INT AUTO_INCREMENT,
    username VARCHAR(255) NOT NULL PRIMARY KEY,
    password VARCHAR(255) NOT NULL
);

INSERT INTO users (username, password) VALUES ('xavier', '1234');
INSERT INTO users (username, password) VALUES ('wellington', '1234');



CREATE TABLE status_info (
    id INT AUTO_INCREMENT PRIMARY KEY,
    life INT(11) NOT NULL,
    ki INT(11) NOT NULL,
    forca INT(11) NOT NULL,
    user_id INT(11),  -- Chave estrangeira para usuários
    FOREIGN KEY (user_id) REFERENCES users(id)  -- Garante que user_id corresponda ao id de usuários
);




ALTER TABLE status_info ADD UNIQUE (user_id);


-- removo registros duplicados com o codigo abaixo

SELECT user_id, COUNT(*) 
FROM status_info 
GROUP BY user_id 
HAVING COUNT(*) > 1;


-- excluo os duplicados

DELETE t1
FROM status_info t1
INNER JOIN status_info t2
WHERE t1.id < t2.id AND t1.user_id = t2.user_id;


-- agora sim
ALTER TABLE status_info ADD UNIQUE (user_id);
