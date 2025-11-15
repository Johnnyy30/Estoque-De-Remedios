create schema monolety;

use monolety;

create table usuario
(
	idUsuario int not null auto_increment,
    nome varchar(255),
    email varchar(255) not null unique,
    senha varchar(255),
    tipo enum('1','2') default 1,
    foto_path VARCHAR(255) NULL DEFAULT 'default.jpg',
    data_upload DATETIME DEFAULT CURRENT_TIMESTAMP;
    primary key(idUsuario)
);


CREATE TABLE remedios (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nome VARCHAR(255) NOT NULL,
  data_vencimento DATE,
  lote VARCHAR(100) NOT NULL,
  quantidade INT NOT NULL
);

INSERT INTO remedios (nome, data_vencimento, lote, quantidade)
VALUES ('Paracetamol 750mg', '2025-12-31', 'A54G8', 150);

INSERT INTO remedios (nome, data_vencimento, lote, quantidade)
VALUES ('Dipirona 500mg', '2026-08-15', 'B22F1', 230);

CREATE TABLE historico_logs (
  id INT AUTO_INCREMENT PRIMARY KEY,
  usuario_nome VARCHAR(255) NOT NULL,
  acao TEXT NOT NULL,
  data_acao TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);