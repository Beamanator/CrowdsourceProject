drop table if exists events;

create table events
( eventid int unsigned not null auto_increment primary key,
  name char(25) not null,
  date char(25) not null,
  time float unsigned not null,
  location char(100) not null
);

insert into events values
	(NULL, 'Soccer Game', '11-8', 14, 'IM Fields'),
	(NULL, 'Movie', '11-14', 19.5, 'Colorado Mills'),
	(NULL, 'Study Group', '11-9', 11, 'CTLM');
	
select * from events;