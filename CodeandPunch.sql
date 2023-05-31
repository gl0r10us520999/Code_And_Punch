
create table users(
username varchar(250) not null,
password varchar(250) not null,
role varchar(250) not null,
name varchar(250) not null,
email varchar(250) not null,
phone_number int not null,
)

insert into users (username) values ('HuyDM')
insert into users (username, password, role, name, email, phone_number) values ('HuyDM','Huy_129222', 'student', 'Huy','huydmhe171027@fpt.edu.vn','0582189459')
insert into users (username, password, role, name, email, phone_number) values ('QuanNH', 'Quan_520999', 'teacher', 'Quân','quannhhe181611@fpt.edu.vn','0338774401')
insert into users (username, password, role, name, email, phone_number) values ('Student1', 'studen_0386113', 'student', 'student1','student123456@fpt.edu.vn','0123456789')
insert into users (username, password, role, name, email, phone_number) values ('HuyDM'), ('Huy_129222'), ('student'), ('Huy'),('huydmhe171027@fpt.edu.vn'),('0582189459')
insert into users (username, password, role, name, email, phone_number) values ('HuyDM'), ('Huy_129222'), ('student'), ('Huy'),('huydmhe171027@fpt.edu.vn'),('0582189459')

