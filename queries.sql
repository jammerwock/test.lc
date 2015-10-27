create database `videofinder`;
use videofinder;

create table `singers` (
  `id`   int(11)     not null auto_increment,
  `name` varchar(50) not null,
  primary key (`id`)
)
  engine = InnoDB
  default charset = utf8;

insert into `singers` (`name`) values
  ('Michael Jackson'),
  ('Adriano Celentano'),
  ('Whitney Houston'),
  ('Mireille Mathieu'),
  ('Charles Aznavour'),
  ('Paul McCartney'),
  ('Tina Turner'),
  ('Alla Pugacheva'),
  ('Madonna'),
  ('Elton John'),
  ('Joe Cocker'),
  ('Stevie Wonder'),
  ('Aretha Franklin'),
  ('Ray Charles'),
  ('Diana Ross'),
  ('Steven Tyler'),
  ('Elvis Presley'),
  ('Freddie Mercury'),
  ('David Bowie'),
  ('Mick Jagger'),
  ('Scorpions'),
  ('James Brown'),
  ('Lionel Richie'),
  ('Ozzy Osbourne'),
  ('Louis Armstrong'),
  ('ABBA'),
  ('Frank Sinatra'),
  ('Chris Rea'),
  ('Tom Jones'),
  ('Luciano Pavarotti'),
  ('Andy Williams'),
  ('Joe Dassin'),
  ('Demis Roussos');

create table `clips` (
  `id`   int(11) not null auto_increment,
  `youtube_id` varchar(20) not null,
  `singer_id` int(11) not null,
  `name` varchar(50) not null,
  `view_count`  int(11) unsigned default 0,
  primary key (`id`)
)
  engine = InnoDB
  default charset = utf8;