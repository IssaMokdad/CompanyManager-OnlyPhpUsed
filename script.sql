
CREATE TABLE Employees(
id int AUTO_INCREMENT,
manager_id int NULL,
name varchar (30),
last_name varchar (30),
email varchar (100) NOT NULL UNIQUE,
PRIMARY KEY(id),
FOREIGN KEY(manager_id) REFERENCES Employees(id) ON DELETE SET NULL ON UPDATE CASCADE);

CREATE TABLE Stores(
id int AUTO_INCREMENT,
name varchar(30) unique,
type varchar(30),
manager_id int,
primary key (id),
foreign key(manager_id) references Employees(manager_id) ON DELETE SET NULL ON UPDATE CASCADE);

CREATE TABLE Rooms(
room_number int,
store_id int,
foreign key (store_id) references Stores(id) ON DELETE SET NULL ON UPDATE CASCADE,
primary key (room_number));

CREATE TABLE Teams(
id int AUTO_INCREMENT,
name varchar(30),
type varchar(30),
primary key (id));

CREATE TABLE Employee_Team(
employee_id int,
team_id int,
PRIMARY KEY(team_id, employee_id),
foreign key (employee_id) references Employees(id) ON DELETE CASCADE ON UPDATE CASCADE,
foreign key (team_id) references Teams(id) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE Team_Admin(
employee_id int,
team_id int,
PRIMARY KEY(team_id),
foreign key (employee_id, team_id) references Employee_Team(employee_id, team_id)  ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE Teams_Rooms(
room_number int,
team_id int,
PRIMARY KEY(room_number, team_id),
foreign key (room_number) references Rooms(room_number),
foreign key (team_id) references Teams(id) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE Admins(
id int AUTO_INCREMENT,
username varchar(30) NOT NULL UNIQUE,
password varchar(255) NOT NULL,
primary key(id)
);

