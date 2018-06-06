use photograph;

create table collection(
		nickname varchar(15),
		photo_id varchar(200),
		primary key(nickname, photo_id),
		foreign key(nickname) references web_user(nickname),
		foreign key(photo_id) references photo(photo_id));
