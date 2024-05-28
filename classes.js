class Atividade {
  constructor(idAtividade, titulo, descricao, video) {
    this.idAtividade = idAtividade;
    this.titulo = titulo;
	this.descricao = descricao;
    this.video = video;
  }
}

class ObservacoesAtividade {
  constructor(idAtividade, campo1Atividade,campo2Gravacao,campo3Lembrete,campo4Outros) {
    this.idAtividade = idAtividade;
    this.campo1Atividade = campo1Atividade;
	this.campo2Gravacao = campo2Gravacao;
    this.campo3Lembrete = campo3Lembrete;
	this.campo4Outros = campo4Outros;
  }
}

class AvaliacaoAtividade {
  constructor(idAtividade, videoAtividade, videoEnviado, campo1Atividade, campo2Gravacao,campo3Lembrete,campo4Outros,resposta) {
    this.idAtividade = idAtividade;
    this.videoAtividade = videoAtividade;
    this.videoEnviado = videoEnviado;
    this.campo1Atividade = campo1Atividade;
	this.campo2Gravacao = campo2Gravacao;
    this.campo3Lembrete = campo3Lembrete;
	this.campo4Outros = campo4Outros;
	this.resposta = resposta;
  }
}

class Resposta {
  constructor(aberta1, aberta2, aberta3, aberta4, perg1, perg2, perg3, perg4, perg5, perg6, perg7, perg8, perg9, perg10, perg11, perg12, perg13, perg14, perg15, perg16, perg17) {
    this.aberta1 = aberta1;
    this.aberta2 = aberta2;
    this.aberta3 = aberta3;
    this.aberta4 = aberta4;
	this.perg1 = perg1;
    this.perg2 = perg2;
    this.perg3 = perg3;
    this.perg4 = perg4;
    this.perg5 = perg5;
    this.perg6 = perg6;
    this.perg7 = perg7;
    this.perg8 = perg8;
    this.perg9 = perg9;
    this.perg10 = perg10;
    this.perg11 = perg11;
    this.perg12 = perg12;
    this.perg13 = perg3;
    this.perg14 = perg14;
    this.perg15 = perg15;
    this.perg16 = perg16;
    this.perg17 = perg17;
  }
}

class Duvida {
  constructor(idAtividade, tituloAtividade, lista, cpf, nome, email) {
    this.idAtividade = idAtividade;
    this.tituloAtividade = tituloAtividade;
	this.lista = lista;
	this.cpf = cpf;
	this.nome = nome;
	this.email = email;
  }
}
class ItemDuvida{
  constructor(id, tempo, titulo, descricao, resposta) {
	this.id = id;
	this.tempo = tempo;
	this.titulo = titulo;
	this.descricao = descricao;
	this.resposta = resposta;
  }
}
