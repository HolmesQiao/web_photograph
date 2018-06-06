drop database photograph;
create database photograph;
use photograph;

create table web_user(
		nickname varchar(15),
		email varchar(30) unique,
		password varchar(15) not null,
		avatar_src varchar(100),
		primary key (nickname));

create table graphy(
		graphy_id varchar(150),
		graphy_name varchar(30) not null,
		nickname varchar(15),
		graphy_avatar varchar(150),
		primary key(graphy_id),
		foreign key(nickname) references web_user(nickname));

create table photo(
		photo_id varchar(200),
		photo_name varchar(100),
		photo_src varchar(200),
		graphy_id varchar(150),
		nickname varchar(15), #if add this, it will not be 3NF
		like_num int,
		time varchar(20),
		primary key(photo_id, photo_src),
#foreign key(graphy_id) references graphy(graphy_id),
		foreign key(nickname) references web_user(nickname));

create table cmt(
		cmt_id varchar(300),
		nickname varchar(15),
		cmt_inner varchar(400) not null,
		re_photo_id varchar(200),
		re_cmt_id varchar(300),
		time varchar(20),
		primary key(cmt_id),
		foreign key(nickname) references web_user(nickname));

create table watch(
		watch_id varchar(30),
		nickname varchar(15),
		watch_name varchar(15),
		primary key(watch_id),
		foreign key(watch_name) references web_user(nickname));
