<?php
class Atividade {
  public $id;
  public $titulo;
  public $descricao;
  public $usuario;
  public $video;
}

class ObservacoesAtividade{
  public $idAtividade;
  public $campo1Atividade;
  public $campo2Gravacao;
  public $campo3Lembrete;
  public $campo4Outros;
  public $titulo;
  public $usuario;
}

class Autoavaliacao{
  public $idAtividade;
  public $titulo;
  public $campo1Atividade;
  public $campo2Gravacao;
  public $campo3Lembrete;
  public $campo4Outros;
  public $videoAtividade;
  public $videoEnviado;
  public $resposta;
}

class Resposta{
  public $perg1;
  public $perg2;
  public $perg3;
  public $perg4;
  public $perg5;
  public $perg6;
  public $perg7;
  public $perg8;
  public $perg9;
  public $perg10;
  public $perg11;
  public $perg12;
  public $perg13;
  public $perg14;
  public $perg15;
  public $perg16;
  public $perg17;
  public $aberta1;
  public $aberta2;
  public $aberta3;
  public $aberta4;
}

class Duvida {
  public $idAtividade;
  public $tituloAtividade;
  public $lista;
  public $cpf;
  public $nome;
  public $email;
}
class ItemDuvida{
  public $id;
  public $titulo;
  public $tempo;
  public $descricao;
  public $resposta;
}

?>