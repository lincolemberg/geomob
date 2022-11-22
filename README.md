# geomob
Geomapeamento de Entulhos (via API Mapbox)

## :globe_with_meridians: O Projeto

Este projeto permite cadastrar objetos georreferenciados e visualizá-los em mapa.

Consulte [Instalação](#instal) para saber como implantar o projeto.

### 📋 Pré-requisitos

Você irá precisar de um servidor local instalado rodando o PHP, como também, um token de acesso válido do <a href="https://account.mapbox.com/access-tokens/">MAPBOX</a>.

```
Servidor local rodando o PHP;
MYSQL instalado com o phpmyadmin;
Navegador compatível como geolocation;
Você pode verificar a compatibilidade do seu navegador rodando o código:

if ("geolocation" in navigator) {
  /* geolocation is available */
} else {
  alert("I'm sorry, but geolocation services are not supported by your browser.");
}
```



### 🔧 <a id="instal">Instalação</a>

Você vai precisar de um servidor local rodando o PHP em sua máquina, pode usar o <a href="https://www.apachefriends.org/pt_br/index.html">XAMPP</a>, por exemplo.
Agora, comece baixando o código e copiando-o na sua pasta raiz do servidor local (htdocs por padrão no Apache).
Você vai precisar de uma conta no <a href="https://account.mapbox.com/auth/signup/">MAPBOX</a> e criar uma <a href="https://account.mapbox.com/access-tokens/">access token</a>.


```
Crie sua token de acesso e copie a chave no arquivo config.php

Use o link da API atual. Neste projeto eu utilizei a versão 3.3.1 do Mapbox.

<script src='https://api.mapbox.com/mapbox.js/v3.3.1/mapbox.js'></script>
<link href='https://api.mapbox.com/mapbox.js/v3.3.1/mapbox.css' rel='stylesheet' />
Include mapbox.js and CSS in your HTML header and call L.mapbox.map('map', 'mapbox.streets') to load your first map.
```


Crie um banco de dados com nome de sua preferência e execute o código sql abaixo:

```
CREATE TABLE objetos (
    id int NOT NULL AUTO_INCREMENT,
    lat varchar(255) NOT NULL,
    log varchar(255),
    titulo varchar(255),
    arquivo varchar(255),
    cidade varchar(255),
    rua varchar(255),
    numero varchar(255),
    bairro varchar(255),
    cep varchar(255),
    reincidencia varchar(255),
    PRIMARY KEY (id)
);
```

## ⚙️ Testando a aplicação

Acesse o seu localhost e cadastre um objeto

```

```


## 📦 Implementação 

Este módulo pode ser utilizado em conjunto com outros sistemas com a finalidade de cadastrar objetos georreferenciados, tais como: obras, irregularidades, entulhos, etc.

## 🛠️ Construído com

Desenvolvido em PHP, Javascript e JSON.

* [API MAPBOX] (https://docs.mapbox.com/api/maps/) - API do MAPBOX
* [PHP](https://www.php.net/) - Linguagem server-side
* [Javascript](https://developer.mozilla.org/pt-BR/docs/Web/JavaScript/) - Linguagem front-end
* [JSON](https://www.json.org/json-en.html) -  acrônimo de JavaScript Object Notation, de troca de dados simples e rápida entre sistemas.


## 📌 Versão 1.0.0

Nós usamos [SemVer](http://semver.org/) para controle de versão.

## ✒️ Autores

Este projeto foi desenvolvido por Lincolemberg Canuto

* **Lincolemberg** - [umdesenvolvedor](https://github.com/lincolemberg)


## 📄 Licença

Este projeto está sob a licença (sua licença) - veja o arquivo [LICENSE.md](https://github.com/usuario/projeto/licenca) para detalhes.

## 🎁 Um café pra dois

* Compartilhe algo bom para as pessoas enquanto a cerveja está gelada 🍺 
* Obrigado 🤓

