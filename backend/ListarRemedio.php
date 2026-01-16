<?php
  include "conexao.php";

  try {
      $consulta_remedios = $conexao->prepare("SELECT id, nome, data_vencimento, lote, quantidade FROM remedios ORDER BY nome ASC");
      $consulta_remedios->execute();

      // Inicializa o array 
      $remedios = array();

      while ($remedio = $consulta_remedios->fetch(PDO::FETCH_ASSOC)) {
          $remedios[] = $remedio; 
      }

      // Define o cabeçalho JSON
      header('Content-Type: application/json; charset=utf-8');

      // Imprime o JSON (se estiver vazio, enviará um array vazio [])
      echo json_encode($remedios, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);

  } catch (PDOException $e) {
      header('Content-Type: application/json', true, 500);
      echo json_encode(["erro" => $e->getMessage()]);
  }
?>