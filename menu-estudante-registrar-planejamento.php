<?php 

// carrega as opcoes de atividade para o select
include 'componente-select-atividades.php';

// carrega as opcoes de atividade que ainda serao planejadas
include 'componente-consulta-planejamento.php';

// encaminha pra tela
header('Location: menu-estudante-registrar-planejamento-tela.php');

?>